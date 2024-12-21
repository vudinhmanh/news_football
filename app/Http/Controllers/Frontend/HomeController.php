<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\PostCatalogue;
use App\Models\SavePost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class HomeController extends Controller
{
    private $categories;
    private $breaking_news;

    public function __construct()
    {
        $this->categories = PostCatalogue::where('parentId', 0)->get();
        $this->breaking_news = Post::where('publish', 2)->orderBy('n_views', 'desc')->limit(3)->get();
    }

    public function index()
    {
        $breaking_news = $this->breaking_news;
        $latest_news = Post::where('publish', 2)->orderBy('id', 'desc')->take(10)->get();
        $featured_news = Post::where('publish', 2)->orderBy('n_comments', 'desc')->limit(4)->get();
        $categories = $this->categories;
        return view('frontend.index', compact(
            'breaking_news',
            'latest_news',
            'categories',
            'featured_news'
        ));
    }

    public function singleCategory($id)
    {
        $category = PostCatalogue::find($id);
        $news = $category->posts()->where('publish', 2)->orderBy('id', 'desc')->get();
        $categories = $this->categories;
        $breaking_news = $this->breaking_news;
        return view('frontend.categories', compact('category', 'news', 'categories', 'breaking_news'));
    }

    public function singleNew($id)
    {
        $new = Post::find($id);
        $new->increment('n_views');
        $my_save_post = !empty(SavePost::where('user_id', Auth::id())->where('post_id', $id)->first());
        $categories = $this->categories;
        $breaking_news = $this->breaking_news;
        return view('frontend.single', compact('new', 'categories', 'my_save_post', 'breaking_news'));
    }

    public function login()
    {
        $url = Socialite::driver('google')->stateless()->redirect()->getTargetUrl();
        return redirect($url);
    }

    public function googleCallback()
    {
        $google_user = Socialite::driver('google')->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))->stateless()->user();

        // Find or create user with email
        $user = User::firstOrCreate(
            ['email' => $google_user->email],
            [
                'name' => $google_user->name,
                'email' => $google_user->email,
                'password' => bcrypt('123456'),
                'user_catalogue_id' => 0,
                'publish' => 2
            ]
        );

        Auth::login($user);

        return redirect()->route('home.index')->with('success', 'Chào mừng bạn đến với trang tin tức');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home.index')->with('success', 'Đã đăng xuất thành công. Hẹn gặp lại bạn');
    }

    public function comment(Request $request)
    {
        $user_id = Auth::id();
        $post_id = $request->input('post_id');
        $content = $request->input('content');

        $comment = new Comment();
        $comment->user_id = $user_id;
        $comment->post_id = $post_id;
        $comment->content = $content;
        $comment->save();

        Post::where('id', $post_id)->increment('n_comments');

        return redirect()->back()->with('success', 'Bình luận của bạn đã được ghi nhận');
    }

    public function savePost(Request $request)
    {
        $user_id = Auth::id();
        $post_id = $request->input('post_id');

        $save_post = SavePost::where('user_id', $user_id)->where('post_id', $post_id)->first();

        if ($save_post) {
            $save_post->delete();
            return redirect()->back()->with('success', 'Đã bỏ lưu tin tức');
        } else {
            $save_post = new SavePost();
            $save_post->user_id = $user_id;
            $save_post->post_id = $post_id;
            $save_post->save();
        }

        return redirect()->back()->with('success', 'Tin tức đã được lưu');
    }

    public function profile()
    {
        $categories = $this->categories;
        $breaking_news = $this->breaking_news;
        return view('frontend.profile', compact('categories', 'breaking_news'));
    }

    public function editProfile(Request $request)
    {
        $name = $request->input('name');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $birthday = $request->input('birthday');

        $update_data = [];

        if (!empty($name)) {
            $update_data['name'] = $name;
        }

        if (!empty($phone)) {
            $update_data['phone'] = $phone;
        }

        if (!empty($address)) {
            $update_data['address'] = $address;
        }

        if (!empty($birthday)) {
            $update_data['birthday'] = $birthday;
        }

        User::where('id', Auth::id())->update($update_data);

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công');
    }

    public function deleteComment($id)
    {
        $comment = Comment::find($id);
        $post_id = $comment->post_id;
        $comment->delete();

        Post::where('id', $post_id)->decrement('n_comments');

        return redirect()->back()->with('success', 'Xóa bình luận thành công');
    }
}
