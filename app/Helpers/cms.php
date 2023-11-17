<?php 
function Blocks(){
  
return(object) $blocks =[
	//All blocks 
'our_clients' => [
    'name' => 'our_clients',
    'sample' => 'our_clients.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'clients'=>['name'=>'clients','type'=>'table'],
      'action'=>['name'=>'action','type'=>'button'],
    ],
  ],
   //Individuals & Professionals
  'individuals_professionals' => [
    'name' => 'individuals_professionals',
    'sample' => 'individuals_professionals.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'subheading'=>['name'=>'subheading','type'=>'text'],
      'action'=>['name'=>'action','type'=>'button'],
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
      'subheading'=>['name'=>'subheading','type'=>'text'],
      'action'=>['name'=>'action','type'=>'button'],
      'list'=>['name'=>'list','type'=>'list'],
      'description'=>['name'=>'description','type'=>'text', 'class'=>'editor'],

    ],
  ],

  //For Professional Freelancers
   'professional_freelancers' => [
    'name' => 'professional_freelancers',
    'sample' => 'professional_freelancers.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'subheading'=>['name'=>'subheading','type'=>'text'],
      'action'=>['name'=>'action','type'=>'button'],
      'list'=>['name'=>'list','type'=>'list'],
      'description'=>['name'=>'description','type'=>'text', 'class'=>'editor'],

    ],
  ],
  //For Investors
  'investors' => [
    'name' => 'investors',
    'sample' => 'investors.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'subheading'=>['name'=>'subheading','type'=>'text'],
      'action'=>['name'=>'action','type'=>'button'],
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
      'reviews'=>['name'=>'reviews','type'=>'table'],

    ],
  ],

  //Mobile Application
  'mobile_application' => [
    'name' => 'mobile_application',
    'sample' => 'mobile_application.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'description'=>['name'=>'description','type'=>'text', 'class'=>'editor'],
      'subheading'=>['name'=>'subheading','type'=>'text'],
      'heading'=>['name'=>'heading','type'=>'text'],
      'android_button'=>['name'=>'button','type'=>'android'],
      'ios_button'=>['name'=>'button','type'=>'ios'],
      'description'=>['name'=>'description','type'=>'text', 'class'=>'editor'],
      'action_one'=>['name'=>'action','type'=>'button'],
      'action_two'=>['name'=>'action','type'=>'button'],

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
      'list'=>['name'=>'list','type'=>'list'],

      'children_one'=>[
        'heading'=>['name'=>'heading','type'=>'text'],
        'icone'=>['name'=>'icone','type'=>'file'],
        'list'=>['name'=>'list','type'=>'list'],
      ],

      'children_two'=>[
        'heading'=>['name'=>'heading','type'=>'text'],
        'icone'=>['name'=>'icone','type'=>'file'],
        'list'=>['name'=>'list','type'=>'list'],
      ],

      'children_three'=>[
        'heading'=>['name'=>'heading','type'=>'text'],
        'icone'=>['name'=>'icone','type'=>'file'],
        'list'=>['name'=>'list','type'=>'list'],
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
      'list'=>['name'=>'list','type'=>'list'],
    ],
  ],

  //INWENT FOR STARTUPS & BUSINESSES
    'startup_businesses' => [
    'name' => 'startup_businesses',
    'sample' => 'startup_businesses.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'list'=>['name'=>'list','type'=>'list'],
      'description'=>['name'=>'description','type'=>'text', 'class'=>'editor'],

       'children'=>[
        'heading'=>['name'=>'heading','type'=>'text'],
        'list'=>['name'=>'list','type'=>'list'],
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
      'list'=>['name'=>'list','type'=>'list'],
       'children'=>[
        'heading'=>['name'=>'heading','type'=>'text'],
        'list'=>['name'=>'list','type'=>'list'],
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
      'comaigns'=>['name'=>'comaigns','type'=>'table'],

    ],
  ],

  //Top Categories
  'categories' => [
    'name' => 'categories',
    'sample' => 'categories.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'sub_heading'=>['name'=>'sub_heading','type'=>'text'],
      'description'=>['name'=>'description','type'=>'text', 'class'=>'editor'],
      'categories'=>['name'=>'categories','type'=>'table'],
    ],
  ],

  //World Is Full with Creativity
  'word_creativity' => [
    'name' => 'word_creativity',
    'sample' => 'word_creativity.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'sub_heading'=>['name'=>'sub_heading','type'=>'text'],
      'action'=>['name'=>'action','type'=>'button'],
      'link'=>['name'=>'link','type'=>'url'],
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
      'comaigns'=>['name'=>'comaigns','type'=>'table'],
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
      'categories'=>['name'=>'categories','type'=>'table'],
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
  'new_articles' => [
    'name' => 'new_articles',
    'sample' => 'new_articles.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'subheading'=>['name'=>'subheading','type'=>'text','class'=>'editor'],
      'action_one'=>['name'=>'action','type'=>'button'],
      'action_two'=>['name'=>'action','type'=>'button'],
      'action_three'=>['name'=>'action','type'=>'button'],
       'children'=>[
        'heading'=>['name'=>'heading','type'=>'text'],
      ],
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
       'children'=>[
        'heading'=>['name'=>'heading','type'=>'text'],
        'sub_heading'=>['name'=>'sub_heading','type'=>'text'],
      ],
    ],
  ],

  //Motivation
  'motivation' => [
    'name' => 'motivation',
    'sample' => 'motivation.png',
    'data' => [
       'children_one'=>[
        'heading'=>['name'=>'heading','type'=>'text'],
        'icone'=>['name'=>'icone','type'=>'file'],
        'sub_heading'=>['name'=>'sub_heading','type'=>'text'],
        'action'=>['name'=>'action','type'=>'button'],
      ],
    ],
  ],
  
  //Browse Projects By Category
'project_by_category' => [
    'name' => 'project_by_category',
    'sample' => 'project_by_category.png',
    'heading'=>['name'=>'heading','type'=>'text'],
    'sub_heading'=>['name'=>'sub_heading','type'=>'text'],
    'data' => [
       'children'=>[
        'heading'=>['name'=>'heading','type'=>'text'],
        'icone'=>['name'=>'icone','type'=>'file'],
        'sub_heading'=>['name'=>'sub_heading','type'=>'text'],
       ],
    ],
  ],

  //More than 50 million professionals on demand
   'professionals_on_demand' => [
    'name' => 'professionals_on_demand',
    'sample' => 'professionals_on_demand.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'sub_heading'=>['name'=>'sub_heading','type'=>'text'],
      'description'=>['name'=>'description','type'=>'text', 'class'=>'editor'],
      'image'=>['name'=>'image','type'=>'file'],
    ],
  ],

  //Most Hired Developers
   'hired_developers' => [
    'name' => 'hired_developers',
    'sample' => 'hired_developers.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'sub_heading'=>['name'=>'sub_heading','type'=>'text'],
      'action'=>['name'=>'action','type'=>'button'],
      //missed few cards in hired Developers//
    ],
  ],

  //Featured Projects for you
  'feactured_projects' => [
    'name' => 'feactured_projects',
    'sample' => 'feactured_projects.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'sub_heading'=>['name'=>'sub_heading','type'=>'text'],

      //missed few cards in Featured Projects//
    ],
  ],

  //Explore all investment opportunities
  'investment_opportunities' => [
    'name' => 'investment_opportunities',
    'sample' => 'investment_opportunities.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'sub_heading'=>['name'=>'sub_heading','type'=>'text'],

      //missed few cards in investment opportunities//
    ],
  ],

  //Get Our Complete1
  'get_our_complete' => [
    'name' => 'get_our_complete',
    'sample' => 'get_our_complete.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'sub_heading'=>['name'=>'sub_heading','type'=>'text'],
      'action'=>['name'=>'action','type'=>'text'],
    ],
  ],
];
}


 ?>
