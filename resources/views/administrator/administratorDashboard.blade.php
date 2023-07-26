@extends('administratorLayout')
@section('title', 'Administrator')

@section('content')
    <div class="container">
        <h1 style="color: white;">Hi admin</h1>

        <div class="row">
            <div class="col-md-4 mb-4">
                <a href="{{ route('viewTenant') }}" class="box-link">
                    <div class="box" style="background-color: #075f98; height: 145px;">
                        <span style="color: white;">Total Tenant</span>
                        <br>
                        <span style="color: white;">{{ $tenantCount }}</span>
                        
                        <div class="box-footer">
                            <span class="view-details">View Details</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="{{ route('viewLandlord') }}" class="box-link">
                    <div class="box" style="background-color: #075f98; height: 145px;">
                        <span style="color: white;">Total Advertiser</span>
                        <br>
                        <span style="color: white;">{{ $advertiserCount }}</span>
                        
                        <div class="box-footer">
                            <span class="view-details">View Details</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="{{ route('viewAdmin') }}" class="box-link">
                    <div class="box" style="background-color: #075f98; height: 145px;">
                        <span style="color: white;">Total Admin</span>
                        <br>
                        <span style="color: white;">{{ $adminCount }}</span>
                        
                        <div class="box-footer">
                            <span class="view-details">View Details</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-4">
                <a href="{{ route('tenantApproval') }}" class="box-link">
                    <div class="box" style="background-color: #075f98; height: 145px;">
                        <span style="color: white;">Total Tenant Approval</span>
                        <br>
                        <span style="color: white;">{{ $pendingTenantCount }}</span>
                        
                        <div class="box-footer">
                            <span class="view-details">View Details</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="{{ route('landlordApproval') }}" class="box-link">
                    <div class="box" style="background-color: #075f98; height: 145px;">
                        <span style="color: white;">Total Landlord Approval</span>
                        <br>
                        <span style="color: white;">{{ $pendingAdvertiserCount }}</span>
                        
                        <div class="box-footer">
                            <span class="view-details">View Details</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="{{ route('showAllPropertyApproval') }}" class="box-link">
                    <div class="box" style="background-color: #075f98; height: 145px;">
                        <span style="color: white;">Total Property Approval</span>
                        <br>
                        <span style="color: white;">{{ $pendingPropertyCount }}</span>
                        
                        <div class="box-footer">
                            <span class="view-details">View Details</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-4">
                <a href="{{ route('viewUserAccManagementReport') }}" class="box-link">
                    <div class="box" style="background-color: #075f98; height: 145px;">
                        <span style="color: white;">User Account Management Report</span>
                        <div class="box-footer">
                            <span class="view-details">View Details</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="{{ route('viewPropRegManagementReport') }}" class="box-link">
                    <div class="box" style="background-color: #075f98; height: 145px;">
                        <span style="color: white;">Property Registration Management Report</span>
                        <div class="box-footer">
                            <span class="view-details">View Details</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="{{ route('viewContentCheckerReport') }}" class="box-link">
                    <div class="box" style="background-color: #075f98; height: 145px;">
                        <span style="color: white;">Content Checker Report</span>
                        <div class="box-footer">
                            <span class="view-details">View Details</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-4">
                <a href="{{ route('viewCheckerForm') }}" class="box-link">
                    <div class="box" style="background-color: #075f98; height: 145px;">
                        <span style="color: white;">Total Content Checker</span>
                        <br>
                        <span style="color: white;">{{ $wordCount }}</span>
                        
                        <div class="box-footer">
                            <span class="view-details">View Details</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <style>
        .box {
            border: 1px solid #ccc;
            padding: 20px;
            text-align: left; /* Align text to the left */
            background-color: #075f98;
            border-radius: 5px;
            width: 100%;
            position: relative; /* Add relative position to enable absolute positioning of the footer */
        }

        .box-link {
            display: block;
            height: 100%;
            text-decoration: none; /* Remove underline from links */
        }

        /* Add spacing between boxes */
        .mb-4 {
            margin-bottom: 20px;
        }

        /* Set text color to white */
        span {
            color: white;
        }

        /* Box footer */
        .box-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #054471; /* Darker shade of blue */
            color: white;
            padding: 5px 10px;
            border-bottom-right-radius: 5px;
            border-bottom-left-radius: 5px;
        }

        /* Right-align "View Details" text */
        .view-details {
            float: right;
        }
    </style>
@endsection
