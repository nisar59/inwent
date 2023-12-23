<?php 


function APPS()
{
  $apps=[
    'inwent'=>[

        'title'=>'Inwent',
        'icon'=>'fas fa-home',
        'bg'=>'#7400B8',
        'permissions'=>[],
        'menu'=>[
          ['title'=>'Roles & Permissions','icon'=>'fas fa-user-shield','url'=>'roles', 'prefix'=>'/roles', 'permissions'=>''],
          ['title'=>'Admins','icon'=>'fas fa-id-card','url'=>'admins','prefix'=>'/admins', 'permissions'=>''],
          ['title'=>'Users','icon'=>'fas fa-users','url'=>'users','prefix'=>'/users', 'permissions'=>''],
        ],
    ],



    'settings'=>[
        'title'=>'Settings',
        'icon'=>'fas fa-cog',
        'bg'=>'#5E60CE',
        'permissions'=>[],
        'menu'=>[
          ['title'=>'General Settings', 'icon'=>'fas fa-cog', 'url'=>'settings','prefix'=>'/settings'],
          ['title'=>'Payments Settings', 'icon'=>'fab fa-paypal', 'url'=>'settings','prefix'=>'/settings', 'permissions'=>''],
          ['title'=>'Email Settings', 'icon'=>'fas fa-envelope', 'url'=>'settings','prefix'=>'/settings', 'permissions'=>''],
          ['title'=>'Social Media Login', 'icon'=>'fas fa-user-lock', 'url'=>'settings','prefix'=>'/settings', 'permissions'=>''],
          ['title'=>'Social Links', 'icon'=>'fas fa-share-alt', 'url'=>'settings','prefix'=>'/settings', 'permissions'=>''],
        ]
    ],



    'cms'=>[
        'title'=>'CMS',
        'icon'=>'fas fa-th-large',
        'bg'=>'#5390D9',
        'permissions'=>[],
        'menu'=>[
          ['title'=>'Pages', 'icon'=>'fab fa-elementor', 'url'=>'pages', 'prefix'=>'/pages', 'permissions'=>''],

          ['title'=>'Main Menu', 'icon'=>'fas fa-bars', 'url'=>'main-menu', 'prefix'=>'/main-menu', 'permissions'=>''],

          ['title'=>'Footer Menu', 'icon'=>'fas fa-chevron-circle-down', 'url'=>'footer-menu-headings', 'prefix'=>'/footer-menu-headings', 'permissions'=>''],

          ['title'=>'Sliders', 'icon'=>'fas fa-sliders-h', 'url'=>'sliders', 'prefix'=>'/sliders', 'permissions'=>''],

          ['title'=>'Banners', 'icon'=>'fas fa-ticket-alt', 'url'=>'banner', 'prefix'=>'/banner', 'permissions'=>''],

          ['title'=>'Action Banners', 'icon'=>'fas fa-money-check', 'url'=>'action-banner', 'prefix'=>'/action-banner', 'permissions'=>''],

          ['title'=>'Our Clients', 'icon'=>'fas fa-restroom', 'url'=>'our-client', 'prefix'=>'/our-client', 'permissions'=>''],

          ['title'=>'Categories', 'icon'=>'fas fa-database', 'url'=>'categories', 'prefix'=>'/categories', 'permissions'=>''],

          ['title'=>'User Reviews', 'icon'=>'fas fa-pen-alt', 'url'=>'user-reviews', 'prefix'=>'/user-reviews', 'permissions'=>''],

          ['title'=>'Inwent Legal', 'icon'=>'fas fa-bible', 'url'=>'inwent-legal', 'prefix'=>'/inwent-legal', 'permissions'=>''],

          ['title'=>'Blogs', 'icon'=>'fas fa-newspaper', 'url'=>'blog-categories', 'prefix'=>'/blog-categories', 'permissions'=>''],

          ['title'=>'Knowledge Base Categories', 'icon'=>'fas fa-list', 'url'=>'knowledge-base-categories', 'prefix'=>'/knowledge-base-categories', 'permissions'=>''],

          ['title'=>'Knowledge Base', 'icon'=>'fas fa-book-open', 'url'=>'knowledge-base', 'prefix'=>'/knowledge-base', 'permissions'=>''],
        ]
    ],



    'network'=>[
        'title'=>'Network',
        'icon'=>'fas fa-bezier-curve',
        'bg'=>'#4EA8DE',
        'permissions'=>[],
        'menu'=>[
          ['title'=>'General Settings', 'icon'=>'fas fa-gear', 'url'=>'', 'prefix'=>'', 'permissions'=>''],
          ['title'=>'Payments Settings', 'icon'=>'fas fa-credit-card', 'url'=>'', 'prefix'=>'', 'permissions'=>''],
          ['title'=>'Email Settings', 'icon'=>'fas fa-credit-card', 'url'=>'', 'prefix'=>'', 'permissions'=>''],
          ['title'=>'Social Media Login', 'icon'=>'fas fa-user-lock', 'url'=>'', 'prefix'=>'', 'permissions'=>''],
          ['title'=>'Social Links', 'icon'=>'fas fa-square-share-nodes', 'url'=>'', 'prefix'=>'', 'permissions'=>''],
        ]
    ],




    'freelancing'=>[
        'title'=>'Freelancing',
        'icon'=>'fas fa-chalkboard-teacher',
        'bg'=>'#48BFE3',
        'permissions'=>[],
        'menu'=>[
          ['title'=>'General Settings', 'icon'=>'fas fa-gear', 'url'=>'', 'prefix'=>'', 'permissions'=>''],
          ['title'=>'Payments Settings', 'icon'=>'fas fa-credit-card', 'url'=>'', 'prefix'=>'', 'permissions'=>''],
          ['title'=>'Email Settings', 'icon'=>'fas fa-credit-card', 'url'=>'', 'prefix'=>'', 'permissions'=>''],
          ['title'=>'Social Media Login', 'icon'=>'fas fa-user-lock', 'url'=>'', 'prefix'=>'', 'permissions'=>''],
          ['title'=>'Social Links', 'icon'=>'fas fa-square-share-nodes', 'url'=>'', 'prefix'=>'', 'permissions'=>''],
        ]
    ],





    'crowd_funding'=>[
        'title'=>'Crowd Funding',
        'icon'=>'fas fa-hand-holding-usd',
        'bg'=>'#56CFE1',
        'permissions'=>[],
        'menu'=>[
          ['title'=>'General Settings', 'icon'=>'fas fa-gear', 'url'=>'', 'prefix'=>'', 'permissions'=>''],
          ['title'=>'Payments Settings', 'icon'=>'fas fa-credit-card', 'url'=>'', 'prefix'=>'', 'permissions'=>''],
          ['title'=>'Email Settings', 'icon'=>'fas fa-credit-card', 'url'=>'', 'prefix'=>'', 'permissions'=>''],
          ['title'=>'Social Media Login', 'icon'=>'fas fa-user-lock', 'url'=>'', 'prefix'=>'', 'permissions'=>''],
          ['title'=>'Social Links', 'icon'=>'fas fa-square-share-nodes', 'url'=>'', 'prefix'=>'', 'permissions'=>''],
        ]
    ],




    'wallet'=>[
        'title'=>'Wallet',
        'icon'=>'fas fa-wallet',
        'bg'=>'#80FFDB',
        'menu'=>[
          ['title'=>'Deposits', 'icon'=>'fas fa-briefcase', 'url'=>'wallet/deposits', 'prefix'=>'/wallet/deposits'],
          ['title'=>'Withdraw', 'icon'=>'fas fa-credit-card', 'url'=>'wallet/withdraw', 'prefix'=>'/wallet/withdraw'],
          ['title'=>'Invoices & Others', 'icon'=>'fas fa-file-invoice-dollar', 'url'=>'', 'prefix'=>'/wallet/invoices'],
          ['title'=>'Wallet Transactions', 'icon'=>'fas fa-receipt', 'url'=>'wallet', 'prefix'=>'wallet'],
        ]
    ],


  ];


  return $apps;
}


function Blocks(){
  
return(object) $blocks =[
	//All blocks 
'our_clients' => [
    'name' => 'our_clients',
    'sample' => 'our_clients.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'our_clients'=>['name'=>'our_clients','type'=>'records', 'entity'=>'CMS\OurClient\Entities\OurClient'],
      'action'=>['name'=>'action','type'=>'button'],
      'action_text'=>['name'=>'action_text','type'=>'text'],
      'action_url'=>['name'=>'action_url','type'=>'text'],
    ],
  ],
   //Individuals & Professionals
  'individuals_professionals' => [
    'name' => 'individuals_professionals',
    'sample' => 'individuals_professionals.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'subheading'=>['name'=>'subheading','type'=>'text','class'=>'editor'],
      'action'=>['name'=>'action','type'=>'button'],
      'action_text'=>['name'=>'action_text','type'=>'text'],
      'action_url'=>['name'=>'action_url','type'=>'text'],
      'list'=>['name'=>'list','type'=>'listing'],
      'description'=>['name'=>'description','type'=>'text', 'class'=>'editor'],

    ],
  ],

  //For Startups & Inventors
  'startups_inventors' => [
    'name' => 'startups_inventors',
    'sample' => 'startups_inventors.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'subheading'=>['name'=>'subheading','type'=>'text', 'class'=>'editor'],

      'action'=>['name'=>'action','type'=>'button'],
      'action_text'=>['name'=>'action_text','type'=>'text'],
      'action_url'=>['name'=>'action_url','type'=>'text'],

      'action_two'=>['name'=>'action_two','type'=>'button'],
      'action_text_two'=>['name'=>'action_text_two','type'=>'text'],
      'action_url_two'=>['name'=>'action_url_two','type'=>'text'],


      'list'=>['name'=>'list','type'=>'listing'],
      'description'=>['name'=>'description','type'=>'text', 'class'=>'editor'],

    ],
  ],

  //For Professional Freelancers
   'professional_freelancers' => [
    'name' => 'professional_freelancers',
    'sample' => 'professional_freelancers.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'subheading'=>['name'=>'subheading','type'=>'text', 'class'=>'editor'],
      'action'=>['name'=>'action','type'=>'button'],
      'action_text'=>['name'=>'action_text','type'=>'text'],
      'action_url'=>['name'=>'action_url','type'=>'text'],
      'list'=>['name'=>'list','type'=>'listing'],
      'description'=>['name'=>'description','type'=>'text', 'class'=>'editor'],

    ],
  ],
  //For Investors
  'investors' => [
    'name' => 'investors',
    'sample' => 'investors.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'subheading'=>['name'=>'subheading','type'=>'text', 'class'=>'editor'],
      'action'=>['name'=>'action','type'=>'button'],
      'action_text'=>['name'=>'action_text','type'=>'text'],
      'action_url'=>['name'=>'action_url','type'=>'text'],
      'list'=>['name'=>'list','type'=>'listing'],
      'description'=>['name'=>'description','type'=>'text', 'class'=>'editor'],

    ],
  ],

  //User Reviews
  'user_reviews' => [
    'name' => 'user_reviews',
    'sample' => 'user_reviews.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'user_reviews'=>['name'=>'user_reviews','type'=>'records' , 'entity'=>'CMS\UserReviews\Entities\UserReviews'],

    ],
  ],

  //Mobile Application
  'mobile_application' => [
    'name' => 'mobile_application',
    'sample' => 'mobile_application.png',
    'data' => [
      'app_banner'=>['name'=>'app_banner', 'type'=>'file'],
      'heading'=>['name'=>'heading','type'=>'text', 'class'=>'editor'],
      'description'=>['name'=>'description','type'=>'text', 'class'=>'editor'],
      'subheading'=>['name'=>'subheading','type'=>'text', 'class'=>'editor'],

      'android_button_url'=>['name'=>'android_button_url','type'=>'text'],

      'ios_button_url'=>['name'=>'ios_button_url','type'=>'text'],

      'sub_description'=>['name'=>'sub_description','type'=>'text', 'class'=>'editor'],

      'action_one'=>['name'=>'action_one','type'=>'button'],
      'action_one_text'=>['name'=>'action_one_text','type'=>'text'],
      'action_one_url'=>['name'=>'action_one_url','type'=>'text'],


      'action_two'=>['name'=>'action_two','type'=>'button'],
      'action_two_text'=>['name'=>'action_two_text','type'=>'text'],
      'action_two_url'=>['name'=>'action_one_url','type'=>'text'],

    ],
  ],
    //INWENT FOR INDIVIDUALS & PROFESSIONALS
 'inwent_for_individuals_professionals' => [
    'name' => 'inwent_for_individuals_professionals',
    'sample' => 'inwent_for_individuals_professionals.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text', 'class'=>'editor'],
      'subheading'=>['name'=>'subheading','type'=>'text', 'class'=>'editor'],
      'action'=>['name'=>'action','type'=>'button'],
      'action_text'=>['name'=>'action_text','type'=>'text'],
      'action_url'=>['name'=>'action_url','type'=>'text'],

      'list'=>['name'=>'list','type'=>'listing'],

      'sub_sections'=>['name'=>'sub_sections', 'type'=>'sub_sections',
        'total_sections'=>3, 
        'sub_sections'=>[
                      'heading'=>['name'=>'heading','type'=>'text'],
                      'icon'=>['name'=>'icon','type'=>'file'],
                      'list'=>['name'=>'list','type'=>'listing'],
                    ],

        ],
      ],

    ],

  //At Inwent, we are connecting all the professional dots together

  'stats' => [
    'name' => 'stats',
    'sample' => 'stats.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text', 'class'=>'editor'],
      'action'=>['name'=>'action','type'=>'button'],
      'action_text'=>['name'=>'action_text','type'=>'text'],
      'action_url'=>['name'=>'action_url','type'=>'text'],

      'list'=>['name'=>'list','type'=>'listing'],
    ],
  ],

  //INWENT FOR STARTUPS & BUSINESSES
  'startup_businesses' => [
    'name' => 'startup_businesses',
    'sample' => 'startup_businesses.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text', 'class'=>'editor'],
      'description'=>['name'=>'description','type'=>'text', 'class'=>'editor'],
      'list'=>['name'=>'list','type'=>'listing'],
      'image'=>['name'=>'image','type'=>'file'],

    ],
  ],

  //INWENT FOR INVESTORS
   'inwent_for_investors' => [
    'name' => 'inwent_for_investors',
    'sample' => 'inwent_for_investors.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text', 'class'=>'editor'],
      'subheading'=>['name'=>'subheading','type'=>'text','class'=>'editor'],
      'list'=>['name'=>'list','type'=>'listing'],
      'image'=>['name'=>'image','type'=>'file'],
    ],
  ],

  //Networking Guide
'guide' => [
    'name' => 'guide',
    'sample' => 'network_guide.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text', 'class'=>'editor'],
      'sub_heading'=>['name'=>'sub_heading','type'=>'text'],
      'action_text'=>['name'=>'action_text','type'=>'text']
    ],
  ],

  //Featured Compaigns
  'featured_comaigns' => [
    'name' => 'featured_comaigns',
    'sample' => 'featured_comaigns.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'sub_heading'=>['name'=>'sub_heading','type'=>'text'],
      'description'=>['name'=>'description','type'=>'text', 'class'=>'editor'],
      'comaigns'=>['name'=>'comaigns','type'=>'records', 'entity'=>'CrowdFunding\CrowdFundingProjects\Entities\CrowdFundingProjects'],

    ],
  ],

  //Top Categories
  'fund_raising_categories' => [
    'name' => 'categories',
    'sample' => 'categories.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'sub_heading'=>['name'=>'sub_heading','type'=>'text'],
      'description'=>['name'=>'description','type'=>'text', 'class'=>'editor'],
      'fund_raising_categories'=>['name'=>'fund_raising_categories','type'=>'records'],
    ],
  ],

  //World Is Full with Creativity
  'word_creativity' => [
    'name' => 'word_creativity',
    'sample' => 'word_creativity.png',
    'data' => [
      'image'=>['name'=>'image', 'type'=>'file'],
      'heading'=>['name'=>'heading','type'=>'text', 'class'=>'editor'],
      'sub_heading'=>['name'=>'sub_heading','type'=>'text', 'class'=>'editor'],
      'action'=>['name'=>'action','type'=>'button'],
      'action_text'=>['name'=>'action_text','type'=>'text'],
      'action_url'=>['name'=>'action_url','type'=>'text'],
      'link'=>['name'=>'link','type'=>'text'],
      'link_text'=>['name'=>'link_text','type'=>'text'],
    ],
  ],

  //Explore All Campaigns
   'all_comaigns' => [
    'name' => 'all_comaigns',
    'sample' => 'all_comaigns.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'sub_heading'=>['name'=>'sub_heading','type'=>'text'],
      'description'=>['name'=>'description','type'=>'text', 'class'=>'editor'],
      'comaigns'=>['name'=>'comaigns','type'=>'records', 'entity'=>'CrowdFunding\CrowdFundingProjects\Entities\CrowdFundingProjects'],
    ],
  ],

  //Get People Talking
  'people_talking' => [
    'name' => 'people_talking',
    'sample' => 'people_talking.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'sub_heading'=>['name'=>'sub_heading','type'=>'text'],
      'image'=>['name'=>'image','type'=>'file'],
    ],
  ],

  //Closing Soon Projects
  'close_soon_project' => [
    'name' => 'close_soon_project',
    'sample' => 'close_soon_project.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'sub_heading'=>['name'=>'sub_heading','type'=>'text'],
      'description'=>['name'=>'description','type'=>'text', 'class'=>'editor'],
      'projects'=>['name'=>'comaigns','type'=>'records', 'entity'=>'CrowdFunding\CrowdFundingProjects\Entities\CrowdFundingProjects'],
    ],
  ],

  //From Idea to Market
  'idea_to_market' => [
    'name' => 'idea_to_market',
    'sample' => 'idea_to_market.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'sub_heading'=>['name'=>'sub_heading','type'=>'text', 'class'=>'editor'],
      'image'=>['name'=>'image','type'=>'file'],
    ],
  ],

  //What They Are Saying
  'what_they_are_saying' => [
    'name' => 'what_they_are_saying',
    'sample' => 'what_they_are_saying.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'user_reviews'=>['name'=>'user_reviews','type'=>'records' , 'entity'=>'CMS\UserReviews\Entities\UserReviews'],
    ],
  ],

  //News & Articles
  'news_articles' => [
    'name' => 'news_articles',
    'sample' => 'news_articles.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'sub_heading'=>['name'=>'sub_heading','type'=>'text'],

      'title_one'=>['name'=>'title_one','type'=>'text', 'class'=>'editor'],
      'title_two'=>['name'=>'title_two','type'=>'text', 'class'=>'editor'],
      'title_three'=>['name'=>'title_three','type'=>'text', 'class'=>'editor'],

      'action_one'=>['name'=>'action_one','type'=>'button'],
      'action_one_text'=>['name'=>'action_one_text','type'=>'text'],
      'action_one_url'=>['name'=>'action_one_url','type'=>'text'],

      
      'action_two'=>['name'=>'action_two','type'=>'button'],
      'action_two_text'=>['name'=>'action_two_text','type'=>'text'],
      'action_two_url'=>['name'=>'action_two_url','type'=>'text'],

      
      'action_three'=>['name'=>'action_three','type'=>'button'],
      'action_three_text'=>['name'=>'action_three_text','type'=>'text'],
      'action_three_url'=>['name'=>'action_three_url','type'=>'text'],

    ],
  ],

  //Crowdfunding Guide
  'crowdfunding_guide' => [
      'name' => 'crowdfunding_guide',
      'sample' => 'crowdfunding_guide.png',
      'data' => [
        'heading'=>['name'=>'heading','type'=>'text'],
        'sub_heading'=>['name'=>'sub_heading','type'=>'text'],
        'action'=>['name'=>'action','type'=>'text'],
      ],
    ],

   //What's great about it?
  'about_it' => [
    'name' => 'about_it',
    'sample' => 'about_it.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'sub_sections'=>['name'=>'sub_sections', 'type'=>'sub_sections',
        'total_sections'=>4, 
        'sub_sections'=>[
                      'heading'=>['name'=>'heading','type'=>'text'],
                      'icon'=>['name'=>'icon','type'=>'file'],
                      'description'=>['name'=>'description','type'=>'text'],
                    ],

        ],
    ],
  ],

  //Motivation
  'motivation' => [
    'name' => 'motivation',
    'sample' => 'motivation.png',
    'data' => [

        'title_one'=>['name'=>'title_one','type'=>'text'],
        'icon_one'=>['name'=>'icon_one','type'=>'file'],
        'description_one'=>['name'=>'description_one','type'=>'text'],

        'action_one'=>['name'=>'action_one','type'=>'button'],
        'action_one_text'=>['name'=>'action_one_text','type'=>'text'],
        'action_one_url'=>['name'=>'action_one_url','type'=>'text'],


        'title_two'=>['name'=>'title_two','type'=>'text'],
        'icon_two'=>['name'=>'icon_two','type'=>'file'],
        'description_two'=>['name'=>'description_two','type'=>'text'],

        'action_two'=>['name'=>'action_two','type'=>'button'],
        'action_two_text'=>['name'=>'action_two_text','type'=>'text'],
        'action_two_url'=>['name'=>'action_two_url','type'=>'text'],


      
    ],
  ],
  
  //Browse Projects By Category
'project_by_category' => [
    'name' => 'project_by_category',
    'sample' => 'project_by_category.png',
    'data' => [    
      'heading'=>['name'=>'heading','type'=>'text'],
      'sub_heading'=>['name'=>'sub_heading','type'=>'text', 'class'=>'editor'],
      'freelancing_categories'=>['name'=>'freelancing_categories', 'type'=>'records']
    ],
  ],

  //More than 50 million professionals on demand
   'professionals_on_demand' => [
    'name' => 'professionals_on_demand',
    'sample' => 'professionals_on_demand.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'sub_heading'=>['name'=>'sub_heading','type'=>'text','class'=>'editor'],
      'image'=>['name'=>'image','type'=>'file'],
      'sub_sections'=>['name'=>'sub_sections', 'type'=>'sub_sections',
        'total_sections'=>4, 
        'sub_sections'=>[
                      'icon'=>['name'=>'icon','type'=>'file'],
                      'heading'=>['name'=>'heading','type'=>'text'],
                      'description'=>['name'=>'description','type'=>'text'],
                    ],

        ],
    ],
  ],

  //Freelancing Projects
   'freelancing_projects' => [
    'name' => 'freelancing_projects',
    'sample' => 'freelancing_projects.png',
    'data' => [
      'freelancing_projects'=>['name'=>'freelancing_projects','type'=>'records', 'entity'=>'Freelancing\Projects\Entities\Projects'],
    ],
  ],


  //Most Hired Developers
   'hired_developers' => [
    'name' => 'hired_developers',
    'sample' => 'hired_developers.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'sub_heading'=>['name'=>'sub_heading','type'=>'text'],
      'freelancers'=>['name'=>'freelancers','type'=>'records'],
      'action'=>['name'=>'action','type'=>'button'],
      'action_text'=>['name'=>'action_text','type'=>'text'],
      'action_url'=>['name'=>'action_url','type'=>'text'],
    ],
  ],

  //Featured Projects for you
  'freelancing_featured_projects' => [
    'name' => 'freelancing_featured_projects',
    'sample' => 'freelancing_featured_projects.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'sub_heading'=>['name'=>'sub_heading','type'=>'text'],
      'freelancing_projects'=>['name'=>'freelancing_projects','type'=>'records', 'entity'=>'Freelancing\Projects\Entities\Projects'],

    ],
  ],


    //Featured Projects for you
  'investment_opportunities' => [
    'name' => 'investment_opportunities',
    'sample' => 'investment_opportunities.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'sub_heading'=>['name'=>'sub_heading','type'=>'text'],
      'freelancing_projects'=>['name'=>'freelancing_projects','type'=>'records', 'entity'=>'Freelancing\Projects\Entities\Projects'],

    ],
  ],


  //User Reviews
  'reviews' => [
    'name' => 'user_reviews',
    'sample' => 'user_reviews.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'user_reviews'=>['name'=>'user_reviews','type'=>'records' , 'entity'=>'CMS\UserReviews\Entities\UserReviews'],

    ],
  ],


  //Get Our Complete1
  'freelancer_guide' => [
    'name' => 'freelancer_guide',
    'sample' => 'freelancer_guide.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'sub_heading'=>['name'=>'sub_heading','type'=>'text'],
      'action'=>['name'=>'action','type'=>'text'],
    ],
  ],
];
}


 ?>
