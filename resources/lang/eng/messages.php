<?php  
return [
    'postCatalogue' => [
        'index' => [
            'title' => 'Post Catalogue Management',
            'table' => 'Post Group List'
        ],
        'create' => [
            'title' => 'Add New Post Group'
        ],
        'edit' => [
            'title' => 'Update Post Group'
        ],
        'delete' => [
            'title' => 'Delete Post Group'
        ],    
    ],
    'post' => [
        'index' => [
            'title' => 'Post Management',
            'table' => 'Post List'
        ],
        'create' => [
            'title' => 'Add New Post'
        ],
        'edit' => [
            'title' => 'Update Post'
        ],
        'delete' => [
            'title' => 'Delete Post'
        ],
    ],
    'userCatalogue' => [
        'index' => [
            'title' => 'User Group Management',
            'table' => 'User Group List'
        ],
        'create' => [
            'title' => 'Add New User Group'
        ],
        'edit' => [
            'title' => 'Update User Group'
        ],
        'delete' => [
            'title' => 'Delete User Group',
            'confirmDelete' => 'You want to delete the member group named:'
        ],
        'permission' => [
            'title' => 'Update Permissions'
        ],  
        'userCatalogueName' => 'User Group Name',
        'userCatalogueDes' => 'Describe',
        'userCatalogueQuantity' => 'Number of members',
        'commonInfor' => 'Enter general information for the member group',
    ],
    'user' => [
        'index' => [
            'title' => 'User Management',
            'table' => 'User List'
        ],
        'create' => [
            'title' => 'Add New User'
        ],
        'edit' => [
            'title' => 'Update User'
        ],
        'delete' => [
            'title' => 'Delete User',
            'confirmDelete' => 'You want to delete a member whose email is:'
        ],
        'permission' => [
            'title' => 'Update Permissions'
        ],  
        'userName' => 'Name',
        'userEmail' => 'Email',
        'userPhone' => 'Phone',
        'userRole' => 'Role',
        'userCatalogue' => 'Member group',
        'dateOfBirth' => 'Date of birth',
        'password' => 'Password',
        'confirmPassword' => 'Confirm password',
        'contactInfor' => 'Contact information',
        'fillContactInfor' => 'Enter user contact information',
        'avatar' => 'Avatar',
        'city' => 'City',
        'chooseCity' => '[Select city]',
        'district' => 'District',
        'chooseDistrict' => '[Select district]',
        'ward' => 'Ward',
        'chooseWard' => '[Select ward]',
        'address' => 'Address',
        'commonInfor' => 'Enter general user information',
    ],
    'permission' => [
        'index' => [
            'title' => 'Permission Management',
            'table' => 'Permission List'
        ],
        'create' => [
            'title' => 'Add New Permission'
        ],
        'edit' => [
            'title' => 'Update Permission'
        ],
        'delete' => [
            'title' => 'Delete Permission'
        ],   
    ],
    'language' => [
        'index' => [
            'title' => 'Language management',
            'table' => 'Language list',
        ],
        'edit' => [
            'title' => 'Update language',
        ],
        'delete' => [
            'title' => 'Delete language',
            'confirmDelete' => 'You want to delete language:',
        ],
        'image' => 'Image',
        'selectImage' => 'Select image',
        'languageName' => 'Language name',
        'keyword' => 'Keyword',
        'commonLang' => 'Enter general language information',
    ],
    'parent' => 'Choose parent category',
    'catalogue' => 'category',
    'parentNotice' => 'Choose Root if there is no parent category',
    'subparent' => 'Choose sub-category (if available)',
    'image' => 'Choose display image',
    'advange' => 'Advanced Configuration',
    'search' => 'Search',
    'searchInput' => 'Enter the keyword you want to search...',
    'perpage' => 'records',
    'title' => 'Title',
    'description' => 'Short description',
    'content' => 'Content',
    'upload' => 'Upload multiple images',
    'seo' => 'SEO Configuration',
    'fillCanonical' => 'You have not entered a path.',
    'fillMetaDescription' => 'You do not have a seo description',
    'seoTitle' => 'You do not have an SEO title yet',
    'seoCanonical' => 'https://your-link.html',
    'seoDescription' => 'You do not have an SEO title yet',
    'seoMetaTitle' => 'SEO Title',
    'seoMetaKeyword' => 'SEO Keyword',
    'seoMetaDescription' => 'SEO Description',
    'canonical' => 'Path',
    'character' => 'Character',
    'tableStatus' => 'Status',
    'tableAction' => 'Actions',
    'tableName' => 'Title',
    'tableOrder' => 'Order',
    'tableGroup' => 'Display Group:',
    'deleteButton' => 'Delete data',
    'tableHeading' => 'General Information',
    'save' => 'Save',
    'cancel' => 'Cancel',
    'delete' => 'Delete',
    'publish' => [
        '0' => 'Choose status',
        '1' => 'Unpublished',
        '2' => 'Published',
    ],
    'follow' => [
        '1' => 'Follow',
        '2' => 'Nofollow',
    ],
    'album' => [
        'heading' => 'Photo Album',
        'image' => 'Choose Image',
        'notice' => 'Use the select image button or click here to add images'
    ],
    'userCatalogueRule' => [
        '0' => 'Select member group',
        '1' => 'Administrator',
        '2' => 'Collaborator'
    ],
    'generalTitle' => 'General Information',
    'generalDescription' => 'You are trying to delete the item named: ',
    'generalWarning' => 'Note: Data cannot be restored after deletion. Please make sure you want to perform this function.',
    'generalRequiredField' => 'Note: Fields marked',
    'isRequired' => 'are required',
    'Note' => 'Note',
];
