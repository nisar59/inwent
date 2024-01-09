<?php

namespace Freelancing\Projects\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Freelancing\ProjectConfig\Entities\ProjectConfig;
use Freelancing\Projects\Entities\ProjectProposals;
use Freelancing\Projects\Entities\ProjectMilestones;
use App\Models\User;
class Projects extends Model
{
    use HasFactory;

    protected $table='freelancing_projects';
    protected $fillable = ['user_id','project_name','project_pic','type_of_work','servive','pricing_type','price','expert_type','industry','job_type','category','qualification','topic_area','experience','activity_type','project_duration','skill_level','job_title','description','deliverables','skills','area_experties','sub_area_experties','certifications','licenses_permits','additional_information_files','web_links','invited_freelancers','agree_to_terms','agree_to_get_offers','status','hired_freelancer', 'hire_date'];
    
    public $with=['user','type_of_work','servive','expert_type','industry', 'job_type', 'category', 'qualification', 'topic_area', 'experience', 'activity_type', 'project_duration', 'skill_level', 'purposals', 'milestones', 'freelancer'];

    public $appends=['all_deliverables', 'all_skills', 'all_area_experties', 'all_sub_area_experties', 'all_certifications', 'all_licenses_permits', 'all_invited_freelancers'];

    protected static function newFactory()
    {
        return \Freelancing\Projects\Database\factories\ProjectsFactory::new();
    }

    public function getProjectPicAttribute($value){
        return StorageFile($value);
    }


    public function getDeliverablesAttribute($value){
        return json_decode($value);
    }

    public function getSkillsAttribute($value){
        return json_decode($value);
    }

    public function getAreaExpertiesAttribute($value){
        return json_decode($value);
    }

    public function getSubAreaExpertiesAttribute($value){
        return json_decode($value);
    }

    public function getCertificationsAttribute($value){
        return json_decode($value);
    }

    public function getLicensesPermitsAttribute($value){
        return json_decode($value);
    }

    public function getAdditionalInformationFilesAttribute($value){
        return json_decode($value);
    }

    public function getWebLinksAttribute($value){
        return json_decode($value);
    }

    public function getInvitedFreelancersAttribute($value){
        return json_decode($value);
    }

    // public function getHiredFreelancerAttribute($value){
    //     return json_decode($value);
    // }


    public function user()
    {
       return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function type_of_work()
    {
       return $this->hasOne(ProjectConfig::class, 'id', 'type_of_work');
    }

    public function servive()
    {
       return $this->hasOne(ProjectConfig::class, 'id', 'servive');
    }

    public function expert_type()
    {
       return $this->hasOne(ProjectConfig::class, 'id', 'expert_type');
    }

    public function industry()
    {
       return $this->hasOne(ProjectConfig::class, 'id', 'industry');
    }

    public function job_type()
    {
       return $this->hasOne(ProjectConfig::class, 'id', 'job_type');
    }

    public function category()
    {
       return $this->hasOne(ProjectConfig::class, 'id', 'category');
    }

    public function qualification()
    {
       return $this->hasOne(ProjectConfig::class, 'id', 'qualification');
    }

    public function topic_area()
    {
       return $this->hasOne(ProjectConfig::class, 'id', 'topic_area');
    }

    public function experience()
    {
       return $this->hasOne(ProjectConfig::class, 'id', 'experience');
    }

    public function activity_type()
    {
       return $this->hasOne(ProjectConfig::class, 'id', 'activity_type');
    }

    public function project_duration()
    {
       return $this->hasOne(ProjectConfig::class, 'id', 'project_duration');
    }

    public function skill_level()
    {
       return $this->hasOne(ProjectConfig::class, 'id', 'skill_level');
    }

    public function freelancer()
    {
       return $this->hasOne(User::class, 'id', 'hired_freelancer');
    }






    public function getAllSkillsAttribute() 
    {
        $ids=$this->skills!=null ? $this->skills : [];
        return ProjectConfig::whereIn('id', $ids)->get();
    }

    public function getAllDeliverablesAttribute() 
    {
        $ids=$this->deliverables!=null ? $this->deliverables : [];
        return ProjectConfig::whereIn('id', $ids)->get();
    }


    public function getAllAreaExpertiesAttribute(){
        $ids=$this->area_experties!=null ? $this->area_experties : [];
        return ProjectConfig::whereIn('id', $ids)->get();
    }

    public function getAllSubAreaExpertiesAttribute(){
        $ids=$this->sub_area_experties!=null ? $this->sub_area_experties : [];
        return ProjectConfig::whereIn('id', $ids)->get();
    }

    public function getAllCertificationsAttribute(){
        $ids=$this->certifications!=null ? $this->certifications : [];
        return ProjectConfig::whereIn('id', $ids)->get();
    }

    public function getAllLicensesPermitsAttribute(){
        $ids=$this->licenses_permits!=null ? $this->licenses_permits : [];
        return ProjectConfig::whereIn('id', $ids)->get();
    }


    public function getAllInvitedFreelancersAttribute(){
        $ids=$this->invited_freelancers!=null ? $this->invited_freelancers : [];
        return ProjectConfig::whereIn('id', $ids)->get();
    }


    public function purposals()
    {
       return $this->hasMany(ProjectProposals::class, 'project_id', 'id');
    }

    public function milestones()
    {
       return $this->hasMany(ProjectMilestones::class, 'project_id', 'id');
    }

}
