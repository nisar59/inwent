@extends('layouts.template')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="page-title">Settings</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="settings.html">Settings</a></li>
                        <li class="breadcrumb-item active">General Settings</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!-- Settings Menu -->
                <div class="settings-menu-links">
                    <ul class="nav nav-tabs menu-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#general-settings" data-bs-toggle="tab">General Settings</a>
                        </li>
<!--                         <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#localization">Localization</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#payment-settings">Payment Settings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#email-settings">Email Settings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#social-settings">Social Media Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#social-links">Social Links</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#seo-settings">SEO Settings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#others-settings">Others</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content pt-0">
                    <div role="tabpanel" id="general-settings" class="tab-pane fade active show">
                        <!-- Settings Menu -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body pt-0">
                                        <div class="card-header">
                                            <h5 class="card-title">Website Basic Details</h5>
                                        </div>
                                        <form method="POST" action="{{url('settings')}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="settings-form row">
                                                <div class="col-md-12 form-group">
                                                    <label>Website URL <span class="star-red">*</span></label>
                                                    <input type="text" value="{{$settings->website_url}}" name="website_url" class="form-control" placeholder="Enter Website URL">
                                                </div>

                                                <div class="col-md-12 form-group">
                                                    <label>Website Name <span class="star-red">*</span></label>
                                                    <input type="text" value="{{$settings->website_name}}" name="website_name" class="form-control" placeholder="Enter Website Name">
                                                </div>

                                                <div class="form-group col-md-8 mt-3">
                                                    <label>Website Logo <span class="star-red">*</span></label>
                                                        <input type="file" accept="image/*" name="website_logo"  onchange="$('#website_logo_preview').attr('src', window.URL.createObjectURL(event.target.files[0]));" class=" form-control">
                                                    <h6 class="settings-size">Recommended image size is <span>157px x 49px</span></h6>
                                                </div>
                                                <div class="col-md-4 form-group mt-3">
                                                    <div class="upload-images m-0 w-100">
                                                        <img src="{{$settings->website_logo}}" id="website_logo_preview" alt="Image">
                                                        <a href="javascript:void(0);"  class="btn-icon logo-hide-btn">
                                                            <i class="feather-x-circle"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                

                                                <div class="form-group col-md-8 mt-3">
                                                    <label class="settings-label">Website Small Logo <span class="star-red">*</span></label>
                                                        <input type="file" accept="image/*" name="website_logo_small" onchange="$('#website_logo_small_preview').attr('src', window.URL.createObjectURL(event.target.files[0]));" class="form-control">
                                                    <h6 class="settings-size">Recommended image size is <span>146px x 33px</span></h6>
                                                </div>
                                                <div class="col-md-4 form-group mt-3">
                                                    <div class="upload-images m-0 w-100">
                                                        <img src="{{$settings->website_logo_small}}" id="website_logo_small_preview" alt="Image">
                                                        <a href="javascript:void(0);" class="btn-icon logo-hide-btn">
                                                            <i class="feather-x-circle"></i>
                                                        </a>
                                                    </div>
                                                </div>


                                                <div class="form-group col-md-10 mt-3">
                                                    <label class="settings-label">Website Favicon <span class="star-red">*</span></label>
                                                        <input type="file" accept="image/*" onchange="$('#website_favicon_preview').attr('src', window.URL.createObjectURL(event.target.files[0]));" name="website_favicon" class="form-control">
                                                    <h6 class="settings-size">
                                                    Recommended image size is <span>16px x 16px or 32px x 32px</span>
                                                    </h6>
                                                    <h6 class="settings-size mt-1">Accepted formats: only png and ico</h6>
                                                </div>
                                                <div class="col-md-2 form-group mt-3">
                                                    <div class="upload-images m-0 w-100 upload-size">
                                                        <img src="{{$settings->website_favicon}}" id="website_favicon_preview" alt="Image">
                                                        <a href="javascript:void(0);" class="btn-icon logo-hide-btn">
                                                            <i class="feather-x-circle"></i>
                                                        </a>
                                                    </div>
                                                </div>



                                                <div class="form-group col-md-8 mt-3">
                                                    <label class="settings-label">Website Footer Logo <span class="star-red">*</span></label>
                                                        <input type="file" accept="image/*" name="website_footer_logo" onchange="$('#website_footer_logo_preview').attr('src', window.URL.createObjectURL(event.target.files[0]));" class="form-control">
                                                    <h6 class="settings-size">Recommended image size is <span>256px x 72px</span></h6>
                                                </div>
                                                <div class="col-md-4 form-group mt-3">
                                                    <div class="upload-images m-0 w-100">
                                                        <img src="{{$settings->website_footer_logo}}" id="website_footer_logo_preview" alt="Image">
                                                        <a href="javascript:void(0);" class="btn-icon logo-hide-btn">
                                                            <i class="feather-x-circle"></i>
                                                        </a>
                                                    </div>
                                                </div>



                                                <div class="form-group col-md-8 mt-3">
                                                    <label class="settings-label">Website Auth Logo <span class="star-red">*</span></label>
                                                        <input type="file" accept="image/*" name="website_auth_logo" onchange="$('#website_auth_logo_preview').attr('src', window.URL.createObjectURL(event.target.files[0]));" class="form-control">
                                                    <h6 class="settings-size">Recommended image size is <span>880px x 251px</span></h6>
                                                </div>
                                                <div class="col-md-4 form-group mt-3">
                                                    <div class="upload-images m-0 w-100">
                                                        <img src="{{$settings->website_auth_logo}}" id="website_auth_logo_preview" alt="Image">
                                                        <a href="javascript:void(0);" class="btn-icon logo-hide-btn">
                                                            <i class="feather-x-circle"></i>
                                                        </a>
                                                    </div>
                                                </div>




                                                <div class="form-group col-md-12 text-end">
                                                    <div class="settings-btns">
                                                        <button type="submit" class="btn btn-orange">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body pt-0">
                                        <div class="card-header">
                                            <h5 class="card-title">Portal Basic Details</h5>
                                        </div>
                                        <form method="POST" action="{{url('settings')}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="settings-form row">
                                                <div class="col-md-12 form-group">
                                                    <label>Portal Name <span class="star-red">*</span></label>
                                                    <input type="text" value="{{$settings->portal_name}}" name="portal_name" class="form-control" placeholder="Enter Portal Name">
                                                </div>

                                                <div class="form-group col-md-8 mt-3">
                                                    <label>Portal Logo <span class="star-red">*</span></label>
                                                        <input type="file" accept="image/*" name="portal_logo"  onchange="$('#portal_logo_preview').attr('src', window.URL.createObjectURL(event.target.files[0]));" class=" form-control">
                                                    <h6 class="settings-size">Recommended image size is <span>150px x 150px</span></h6>
                                                </div>
                                                <div class="col-md-4 form-group mt-3">
                                                    <div class="upload-images m-0 w-100">
                                                        <img src="{{$settings->portal_logo}}" id="portal_logo_preview" alt="Image">
                                                        <a href="javascript:void(0);"  class="btn-icon logo-hide-btn">
                                                            <i class="feather-x-circle"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                

                                                <div class="form-group col-md-8 mt-3">
                                                    <label class="settings-label">Portal Small Logo <span class="star-red">*</span></label>
                                                        <input type="file" accept="image/*" name="portal_logo_small" onchange="$('#portal_logo_small_preview').attr('src', window.URL.createObjectURL(event.target.files[0]));" class="form-control">
                                                    <h6 class="settings-size">Recommended image size is <span>150px x 150px</span></h6>
                                                </div>
                                                <div class="col-md-4 form-group mt-3">
                                                    <div class="upload-images m-0 w-100">
                                                        <img src="{{$settings->portal_logo_small}}" id="portal_logo_small_preview" alt="Image">
                                                        <a href="javascript:void(0);" class="btn-icon logo-hide-btn">
                                                            <i class="feather-x-circle"></i>
                                                        </a>
                                                    </div>
                                                </div>


                                                <div class="form-group col-md-10 mt-3">
                                                    <label class="settings-label">Portal Favicon <span class="star-red">*</span></label>
                                                        <input type="file" accept="image/*" onchange="$('#portal_favicon').attr('src', window.URL.createObjectURL(event.target.files[0]));" name="portal_favicon" class="form-control">
                                                    <h6 class="settings-size">
                                                    Recommended image size is <span>16px x 16px or 32px x 32px</span>
                                                    </h6>
                                                    <h6 class="settings-size mt-1">Accepted formats: only png and ico</h6>
                                                </div>
                                                <div class="col-md-2 form-group mt-3">
                                                    <div class="upload-images m-0 w-100 upload-size">
                                                        <img id="portal_favicon" src="{{$settings->portal_favicon}}" alt="Image">
                                                        <a href="javascript:void(0);" class="btn-icon logo-hide-btn">
                                                            <i class="feather-x-circle"></i>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-12 text-end">
                                                    <div class="settings-btns">
                                                        <button type="submit" class="btn btn-orange">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<!--                     <div role="tabpanel" id="localization" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body pt-0">
                                        <div class="card-header">
                                            <h5 class="card-title">Localization Details</h5>
                                        </div>
                                        <form>
                                            <div class="settings-form">
                                                <div class="form-group">
                                                    <label>Time Zone</label>
                                                    <select class="select form-control">
                                                        <option selected="selected">(UTC +5:30) Antarctica/Palmer</option>
                                                        <option>(UTC+05:30) India</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Date Format</label>
                                                    <select class="form-control">
                                                        <option selected="selected">15 May 2016</option>
                                                        <option>15/05/2016</option>
                                                        <option>15.05.2016</option>
                                                        <option>15-05-2016</option>
                                                        <option>05/15/2016</option>
                                                        <option>2016/05/15</option>
                                                        <option>2016-05-15</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Time Format</label>
                                                    <select class="form-control">
                                                        <option selected="selected">12 Hours</option>
                                                        <option>24 Hours</option>
                                                        <option>36 Hours</option>
                                                        <option>48 Hours</option>
                                                        <option>60 Hours</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Currency Symbol</label>
                                                    <select class="form-control">
                                                        <option selected="selected">$</option>
                                                        <option>₹</option>
                                                        <option>£</option>
                                                        <option>€</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <div class="settings-btns">
                                                        <button type="submit" class="btn btn-orange">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div role="tabpanel" id="payment-settings" class="tab-pane fade">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body pt-0">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <h5 class="card-title">Paypal</h5>
                                            </div>
                                            <form method="POST" action="{{url('settings')}}">
                                                @csrf
                                                <div class="settings-form">
                                                    <div class="form-group">
                                                        <p class="pay-cont">Paypal Option</p>
                                                        <label class="custom_radio me-4">
                                                            <input type="radio" class="paypal-mode" name="paypal_mode" value="0" @if($settings->paypal_mode!=1 && $settings->paypal_mode!='1') checked @endif>
                                                            <span class="checkmark"></span> Sandbox
                                                        </label>
                                                        <label class="custom_radio">
                                                            <input type="radio" class="paypal-mode" name="paypal_mode" value="1" @if($settings->paypal_mode==1 || $settings->paypal_mode=='1') checked @endif>
                                                            <span class="checkmark"></span> Live
                                                        </label>
                                                    </div>
                                                    <div id="sandbox">
                                                        <div class="form-group form-placeholder">
                                                            <label>Paypal Sandbox Client ID<span class="star-red">*</span></label>
                                                            <input type="text" value="{{$settings->paypal_sandbox_client_id}}" name="paypal_sandbox_client_id" class="form-control" placeholder="Paypal Sandbox Client ID">
                                                        </div>
                                                        <div class="form-group form-placeholder">
                                                            <label>Paypal Sandbox Client Secret<span class="star-red">*</span></label>
                                                            <input type="text" value="{{$settings->paypal_sandbox_client_secret}}" name="paypal_sandbox_client_secret" class="form-control" placeholder="Paypal Sandbox Client Secret">
                                                        </div>
                                                        <div class="form-group form-placeholder">
                                                            <label>Paypal Sandbox APP ID<span class="star-red">*</span></label>
                                                            <input type="text" value="{{$settings->paypal_sandbox_app_id}}" name="paypal_sandbox_app_id" class="form-control" placeholder="Paypal Sandbox APP ID">
                                                        </div>
                                                    </div>

                                                   <div id="live">
                                                        <div class="form-group form-placeholder">
                                                            <label>Paypal Live Client ID<span class="star-red">*</span></label>
                                                            <input type="text" value="{{$settings->paypal_live_client_id}}" name="paypal_live_client_id" class="form-control" placeholder="Paypal Live Client ID">
                                                        </div>
                                                        <div class="form-group form-placeholder">
                                                            <label>Paypal Live Client Secret<span class="star-red">*</span></label>
                                                            <input type="text" value="{{$settings->paypal_live_client_secret}}" name="paypal_live_client_secret" class="form-control" placeholder="Paypal Live Client Secret">
                                                        </div>
                                                        <div class="form-group form-placeholder">
                                                            <label>Paypal Live APP ID<span class="star-red">*</span></label>
                                                            <input type="text" value="{{$settings->paypal_live_app_id}}" name="paypal_live_app_id" class="form-control" placeholder="Paypal Live APP ID">
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-0">
                                                        <div class="settings-btns">
                                                            <button type="submit" class="btn btn-orange">Save</button>
                                                            <a href="{{url('/')}}" class="btn btn-grey">Cancel</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body pt-0">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <h5 class="card-title">Stripe</h5>
                                                <div class="status-toggle d-flex justify-content-between align-items-center">
                                                    <input type="checkbox" id="status_2" class="check" checked="">
                                                    <label for="status_2" class="checktoggle">checkbox</label>
                                                </div>
                                            </div>
                                            <form>
                                                <div class="settings-form">
                                                    <div class="form-group">
                                                        <p class="pay-cont">Stripe Option</p>
                                                        <label class="custom_radio me-4">
                                                            <input type="radio" name="budget" value="Yes" checked="">
                                                            <span class="checkmark"></span> Sandbox
                                                        </label>
                                                        <label class="custom_radio">
                                                            <input type="radio" name="budget" value="Yes">
                                                            <span class="checkmark"></span> Live
                                                        </label>
                                                    </div>
                                                    <div class="form-group form-placeholder">
                                                        <label>Gateway Name <span class="star-red">*</span></label>
                                                        <input type="text" class="form-control" placeholder="Stripe">
                                                    </div>
                                                    <div class="form-group form-placeholder">
                                                        <label>API Key <span class="star-red">*</span></label>
                                                        <input type="text" class="form-control" placeholder="pk_test_AealxxOygZz84AruCGadWvUV00mJQZdLvr">
                                                    </div>
                                                    <div class="form-group form-placeholder">
                                                        <label>Rest Key <span class="star-red">*</span></label>
                                                        <input type="text" class="form-control" placeholder="sk_test_8HwqAWwBd4C4E77bgAO1jUgk00hDlERgn3">
                                                    </div>
                                                    <div class="form-group mb-0">
                                                        <div class="settings-btns">
                                                            <button type="submit" class="btn btn-orange">Save</button>
                                                            <button type="submit" class="btn btn-grey">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div role="tabpanel" id="email-settings" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body pt-0">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h5 class="card-title">PHP Mail</h5>
                                            <div class="status-toggle d-flex justify-content-between align-items-center">
                                                <input type="checkbox" id="status_1" class="check">
                                                <label for="status_1" class="checktoggle">checkbox</label>
                                            </div>
                                        </div>
                                        <form>
                                            <div class="settings-form">
                                                <div class="form-group form-placeholder">
                                                    <label>Email From Address <span class="star-red">*</span></label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group form-placeholder">
                                                    <label>Email Password <span class="star-red">*</span></label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group form-placeholder">
                                                    <label>Emails From Name <span class="star-red">*</span></label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group mb-0">
                                                    <div class="settings-btns">
                                                        <button type="submit" class="btn btn-orange">Submit</button>
                                                        <button type="submit" class="btn btn-grey">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body pt-0">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h5 class="card-title">SMTP</h5>
                                            <div class="status-toggle d-flex justify-content-between align-items-center">
                                                <input type="checkbox" id="status_2" class="check" checked="">
                                                <label for="status_2" class="checktoggle">checkbox</label>
                                            </div>
                                        </div>
                                        <form>
                                            <div class="settings-form">
                                                <div class="form-group form-placeholder">
                                                    <label>Email From Address <span class="star-red">*</span></label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group form-placeholder">
                                                    <label>Email Password <span class="star-red">*</span></label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group form-placeholder">
                                                    <label>Email Host <span class="star-red">*</span></label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group form-placeholder">
                                                    <label>Email Port <span class="star-red">*</span></label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group mb-0">
                                                    <div class="settings-btns">
                                                        <button type="submit" class="btn btn-orange">Submit</button>
                                                        <button type="submit" class="btn btn-grey">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" id="social-settings" class="tab-pane fade">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body pt-0">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="card-title">Google Login Credential</h5>
                                        <div class="status-toggle d-flex justify-content-between align-items-center">
                                            <input type="checkbox" id="status_1" class="check" checked="">
                                            <label for="status_1" class="checktoggle">checkbox</label>
                                        </div>
                                    </div>
                                    <form>
                                        <div class="settings-form">
                                            <div class="form-group form-placeholder">
                                                <label>Client ID <span class="star-red">*</span></label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="form-group form-placeholder">
                                                <label>Client Secret <span class="star-red">*</span></label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="form-group mb-0">
                                                <div class="settings-btns">
                                                    <button type="submit" class="btn btn-orange">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body pt-0">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="card-title">Facebook</h5>
                                        <div class="status-toggle d-flex justify-content-between align-items-center">
                                            <input type="checkbox" id="status_2" class="check" checked="">
                                            <label for="status_2" class="checktoggle">checkbox</label>
                                        </div>
                                    </div>
                                    <form>
                                        <div class="settings-form">
                                            <div class="form-group form-placeholder">
                                                <label>App ID <span class="star-red">*</span></label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="form-group form-placeholder">
                                                <label>App Secret <span class="star-red">*</span></label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="form-group mb-0">
                                                <div class="settings-btns">
                                                    <button type="submit" class="btn btn-orange">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body pt-0">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="card-title">Twiter Login Credential</h5>
                                        <div class="status-toggle d-flex justify-content-between align-items-center">
                                            <input type="checkbox" id="status_3" class="check">
                                            <label for="status_3" class="checktoggle">checkbox</label>
                                        </div>
                                    </div>
                                    <form>
                                        <div class="settings-form">
                                            <div class="form-group form-placeholder">
                                                <label>Client ID <span class="star-red">*</span></label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="form-group form-placeholder">
                                                <label>Client Secret <span class="star-red">*</span></label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="form-group mb-0">
                                                <div class="settings-btns">
                                                    <button type="submit" class="btn btn-orange">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div role="tabpanel" id="social-links" class="tab-pane fade">
                        <div class="row">
                            <div class="col-lg-6 col-md-8">
                                <div class="card">
                                    <div class="card-body pt-0">
                                        <div class="card-header">
                                            <h5 class="card-title">Social Link Settings</h5>
                                        </div>
                                        <form>
                                            <div class="settings-form">
                                                <div class="links-info">
                                                    <div class="row form-row links-cont">
                                                        <div class="col-12 col-md-11">
                                                            <div class="form-group form-placeholder d-flex">
                                                                <button class="btn social-icon">
                                                                    <i class="feather-facebook"></i>
                                                                </button>
                                                                <input type="text" class="form-control" placeholder="https://www.facebook.com">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-1">
                                                            <a href="#" class="btn trash">
                                                                <i class="feather-trash-2"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="links-info">
                                                    <div class="row form-row links-cont">
                                                        <div class="col-12 col-md-11">
                                                            <div class="form-group form-placeholder d-flex">
                                                                <button class="btn social-icon">
                                                                    <i class="feather-twitter"></i>
                                                                </button>
                                                                <input type="text" class="form-control" placeholder="https://www.twitter.com">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-1">
                                                            <a href="#" class="btn trash">
                                                                <i class="feather-trash-2"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="links-info">
                                                    <div class="row form-row links-cont">
                                                        <div class="col-12 col-md-11">
                                                            <div class="form-group form-placeholder d-flex">
                                                                <button class="btn social-icon">
                                                                    <i class="feather-youtube"></i>
                                                                </button>
                                                                <input type="text" class="form-control" placeholder="https://www.youtube.com">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-1">
                                                            <a href="#" class="btn trash">
                                                                <i class="feather-trash-2"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="links-info">
                                                    <div class="row form-row links-cont">
                                                        <div class="col-12 col-md-11">
                                                            <div class="form-group form-placeholder d-flex">
                                                                <button class="btn social-icon">
                                                                    <i class="feather-linkedin"></i>
                                                                </button>
                                                                <input type="text" class="form-control" placeholder="https://www.linkedin.com">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-1">
                                                            <a href="#" class="btn trash">
                                                                <i class="feather-trash-2"></i>
                                                            </a>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <a href="javascript:void(0);" class="btn add-links">
                                                    <i class="fas fa-plus me-1"></i> Add More
                                                </a>
                                            </div>
                                            <div class="form-group mb-0">
                                                <div class="settings-btns">
                                                    <button type="submit" class="btn btn-orange">Submit</button>
                                                    <button type="submit" class="btn btn-grey">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" id="seo-settings" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body pt-0">
                                        <div class="card-header">
                                            <h5 class="card-title">SEO Settings</h5>
                                        </div>
                                        <form>
                                            <div class="settings-form">
                                                <div class="form-group form-placeholder">
                                                    <label>Meta Title <span class="star-red">*</span></label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Meta Keywords <span class="star-red">*</span></label>
                                                    <input type="text" data-role="tagsinput" class="input-tags form-control" placeholder="Meta Keywords" name="services" value="Lorem,Ipsum" id="services">
                                                </div>
                                                <div class="form-group">
                                                    <label>Meta Description <span class="star-red">*</span></label>
                                                    <textarea class="form-control"></textarea>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <div class="settings-btns">
                                                        <button type="submit" class="btn btn-orange">Submit</button>
                                                        <button type="submit" class="btn btn-grey">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" id="others-settings" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body pt-0">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h5 class="card-title">Enable Google Analytics</h5>
                                            <div class="status-toggle d-flex justify-content-between align-items-center">
                                                <input type="checkbox" id="status_1" class="check" checked="">
                                                <label for="status_1" class="checktoggle">checkbox</label>
                                            </div>
                                        </div>
                                        <form>
                                            <div class="settings-form">
                                                <div class="form-group">
                                                    <label>Google Analytics <span class="star-red">*</span></label>
                                                    <textarea class="form-control" placeholder="Google Analytics"></textarea>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <div class="settings-btns">
                                                        <button type="submit" class="btn btn-orange">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body pt-0">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h5 class="card-title">Enable Google Adsense Code</h5>
                                            <div class="status-toggle d-flex justify-content-between align-items-center">
                                                <input type="checkbox" id="status_2" class="check" checked="">
                                                <label for="status_2" class="checktoggle">checkbox</label>
                                            </div>
                                        </div>
                                        <form>
                                            <div class="settings-form">
                                                <div class="form-group">
                                                    <label>Google Adsense Code <span class="star-red">*</span></label>
                                                    <textarea class="form-control" placeholder="Google Adsense Code"></textarea>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <div class="settings-btns">
                                                        <button type="submit" class="btn btn-orange">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body pt-0">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h5 class="card-title">Display Facebook Messenger</h5>
                                            <div class="status-toggle d-flex justify-content-between align-items-center">
                                                <input type="checkbox" id="status_3" class="check" checked="">
                                                <label for="status_3" class="checktoggle">checkbox</label>
                                            </div>
                                        </div>
                                        <form>
                                            <div class="settings-form">
                                                <div class="form-group">
                                                    <label>Facebook Messenger <span class="star-red">*</span></label>
                                                    <textarea class="form-control" placeholder="Facebook Messenger"></textarea>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <div class="settings-btns">
                                                        <button type="submit" class="btn btn-orange">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body pt-0">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h5 class="card-title">Display Facebook Pixel</h5>
                                            <div class="status-toggle d-flex justify-content-between align-items-center">
                                                <input type="checkbox" id="status_4" class="check" checked="">
                                                <label for="status_4" class="checktoggle">checkbox</label>
                                            </div>
                                        </div>
                                        <form>
                                            <div class="settings-form">
                                                <div class="form-group">
                                                    <label>Google Adsense Code <span class="star-red">*</span></label>
                                                    <textarea class="form-control" placeholder="Google Adsense Code"></textarea>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <div class="settings-btns">
                                                        <button type="submit" class="btn btn-orange">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex">
                                <div class="card w-100">
                                    <div class="card-body pt-0">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h5 class="card-title">Display Google Recaptcha</h5>
                                            <div class="status-toggle d-flex justify-content-between align-items-center">
                                                <input type="checkbox" id="status_5" class="check" checked="">
                                                <label for="status_5" class="checktoggle">checkbox</label>
                                            </div>
                                        </div>
                                        <form>
                                            <div class="settings-form">
                                                <div class="form-group form-placeholder">
                                                    <label>Google Rechaptcha Site Key <span class="star-red">*</span></label>
                                                    <input type="text" class="form-control" placeholder="6LcnPoEaAAAAAF6QhKPZ8V4744yiEnr41li3SYDn">
                                                </div>
                                                <div class="form-group form-placeholder">
                                                    <label>Google Rechaptcha Secret Key <span class="star-red">*</span></label>
                                                    <input type="text" class="form-control" placeholder="6LcnPoEaAAAAACV_xC4jdPqumaYKBnxz9Sj6y0zk">
                                                </div>
                                                <div class="form-group mb-0">
                                                    <div class="settings-btns">
                                                        <button type="submit" class="btn btn-orange">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex">
                                <div class="card w-100">
                                    <div class="card-body pt-0">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h5 class="card-title">Cookies Agreement</h5>
                                            <div class="status-toggle d-flex justify-content-between align-items-center">
                                                <input type="checkbox" id="status_6" class="check" checked="">
                                                <label for="status_6" class="checktoggle">checkbox</label>
                                            </div>
                                        </div>
                                        <form>
                                            <div class="settings-form">
                                                <div class="form-group">
                                                    <label>Cookies Agreement Text <span class="star-red">*</span></label>
                                                    <div></div>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <div class="settings-btns">
                                                        <button type="submit" class="btn btn-orange">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Page Wrapper -->
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function () {
        
        function paypalMode() {
            var mode=$(".paypal-mode:checked").val();
           if(mode!=1 && mode!='1'){
            $("#sandbox").show();
            $("#live").hide();
           }else{
            $("#live").show();
            $("#sandbox").hide();
           }
        }
        paypalMode();
    $(document).on('change', '.paypal-mode', function() {
        paypalMode();
    });

    });
</script>
@endsection
