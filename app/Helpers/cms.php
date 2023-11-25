<?php 
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
      'heading'=>['name'=>'heading','type'=>'text'],
      'subheading'=>['name'=>'subheading','type'=>'text'],
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

  'professional_dots_together' => [
    'name' => 'professional_dots_together',
    'sample' => 'professional_dots_together.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
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
      'heading'=>['name'=>'heading','type'=>'text'],
      'description'=>['name'=>'description','type'=>'text', 'class'=>'editor'],
      'list'=>['name'=>'list','type'=>'listing'],

      'sub_sections'=>['name'=>'sub_sections', 'type'=>'sub_sections',
        'total_sections'=>1, 
        'sub_sections'=>[
                      'heading'=>['name'=>'heading','type'=>'text'],
                      'list'=>['name'=>'list','type'=>'listing'],
                    ],

        ],

    ],
  ],

  //INWENT FOR INVESTORS
   'inwent_for_investors' => [
    'name' => 'inwent_for_investors',
    'sample' => 'inwent_for_investors.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'subheading'=>['name'=>'subheading','type'=>'text','class'=>'editor'],
      'list'=>['name'=>'list','type'=>'listing'],
      'sub_sections'=>['name'=>'sub_sections', 'type'=>'sub_sections',
        'total_sections'=>1, 
        'sub_sections'=>[
                      'heading'=>['name'=>'heading','type'=>'text'],
                      'list'=>['name'=>'list','type'=>'listing'],
                    ],

        ],
    ],
  ],

  //Networking Guide
'network_guide' => [
    'name' => 'network_guide',
    'sample' => 'network_guide.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'sub_heading'=>['name'=>'sub_heading','type'=>'text'],
      'action'=>['name'=>'action','type'=>'text'],
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
      'comaigns'=>['name'=>'comaigns','type'=>'records'],

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
      'heading'=>['name'=>'heading','type'=>'text'],
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
      'comaigns'=>['name'=>'comaigns','type'=>'records'],
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
      'projects'=>['name'=>'comaigns','type'=>'records'],
    ],
  ],

  //From Idea to Market
  'idea_to_market' => [
    'name' => 'idea_to_market',
    'sample' => 'idea_to_market.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'sub_heading'=>['name'=>'sub_heading','type'=>'text'],
      'image'=>['name'=>'image','type'=>'file'],
    ],
  ],

  //What They Are Saying
  'what_they_are_saying' => [
    'name' => 'what_they_are_saying',
    'sample' => 'what_they_are_saying.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'reviews'=>['name'=>'reviews','type'=>'table'],
    ],
  ],

  //News & Articles
  'news_articles' => [
    'name' => 'news_articles',
    'sample' => 'news_articles.png',
    'data' => [
      'heading_one'=>['name'=>'heading_one','type'=>'text'],
      'action_one'=>['name'=>'action_one','type'=>'button'],
      'action_one_text'=>['name'=>'action_one_text','type'=>'text'],
      'action_one_url'=>['name'=>'action_one_url','type'=>'text'],

      'heading_two'=>['name'=>'heading_two','type'=>'text'],
      'action_two'=>['name'=>'action_two','type'=>'button'],
      'action_two_text'=>['name'=>'action_two_text','type'=>'text'],
      'action_two_url'=>['name'=>'action_two_url','type'=>'text'],

      'heading_three'=>['name'=>'heading_three','type'=>'text'],
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
       'children_one'=>[
        'heading_one'=>['name'=>'heading_one','type'=>'text'],
        'icon_one'=>['name'=>'icon_one','type'=>'file'],
        'sub_heading_one'=>['name'=>'sub_heading_one','type'=>'text'],

        'action_one'=>['name'=>'action_one','type'=>'button'],
        'action_one_text'=>['name'=>'action_one_text','type'=>'text'],
        'action_one_url'=>['name'=>'action_one_url','type'=>'text'],


        'heading_two'=>['name'=>'heading_two','type'=>'text'],
        'icon_two'=>['name'=>'icon_two','type'=>'file'],
        'sub_heading_two'=>['name'=>'sub_heading_two','type'=>'text'],

        'action_two'=>['name'=>'action_two','type'=>'button'],
        'action_two_text'=>['name'=>'action_two_text','type'=>'text'],
        'action_two_url'=>['name'=>'action_two_url','type'=>'text'],


      ],
    ],
  ],
  
  //Browse Projects By Category
'project_by_category' => [
    'name' => 'project_by_category',
    'sample' => 'project_by_category.png',
    'data' => [    
      'heading'=>['name'=>'heading','type'=>'text'],
      'sub_heading'=>['name'=>'sub_heading','type'=>'text'],
      'freelancing_categories'=>['name'=>'freelancing_categories', 'type'=>'records']
    ],
  ],

  //More than 50 million professionals on demand
   'professionals_on_demand' => [
    'name' => 'professionals_on_demand',
    'sample' => 'professionals_on_demand.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'sub_heading'=>['name'=>'sub_heading','type'=>'text'],
      'image'=>['name'=>'image','type'=>'file'],
      'sub_sections'=>['name'=>'sub_sections', 'type'=>'sub_sections',
        'total_sections'=>1, 
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
      'freelancing_projects'=>['name'=>'freelancing_projects','type'=>'records'],
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
      'freelancing_projects'=>['name'=>'freelancing_projects','type'=>'records'],

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
