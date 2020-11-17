@php
    use App\Models\LeadsComment;
@endphp
@extends('layouts.adminlayout.admin_design')
@section('content')

<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-news-paper"></i>
                    </div>
                    <div>Attendence

                    </div>
                </div>

             </div>
        </div>
        <div class="alert alert-success" id="success-alert-signin" style="display:none">SignIn Sucessfully</div>
        <div class="alert alert-success" id="success-alert-signout" style="display:none">SignOut Sucessfully</div>
              <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-header">Attendence</div>
                        <div class="card-body">
                            <div class="text-center">
                                <form method="POST">
                                @if ($log_status->log_status==0)
                                <button class="btn-wide mb-2 mr-2 btn btn-shadow btn-primary btn-lg"  value="logIn">LogIn</button>
                                @else
                                <button class="btn-wide mb-2 mr-2 btn btn-shadow btn-primary btn-lg"  value="logout">LogOut</button>
                                @endif


                                <p><span id="datetime"></span></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <!-- Large modal -->
@endsection
