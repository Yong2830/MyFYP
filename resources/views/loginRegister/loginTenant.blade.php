@extends('loginRegisterLayout')
@section('title', 'Login')
@section('scripts')
    @if (session('status') === 'deactivated')
        <script>
            $(document).ready(function() {
                $('#deactivatedModal').modal('show');
            });
        </script>
    @elseif (session('pendingStatus') === 'pending')
        <script>
            $(document).ready(function() {
                $('#pendingModal').modal('show');
            });
        </script>
    @elseif (session('rejectedStatus') === 'rejected')
        <script>
            $(document).ready(function() {
                $('#rejectedModal').modal('show');
            });
        </script>
    @endif
@endsection

@section('content')
    <div style="margin-top: 12rem;"></div>
    <h3 class="mb-4">Web Based Property Rental System</h3>


    <form method="POST" action="{{ route('loginTenantAction') }}">
        @csrf

        <div class="mb-4">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" autofocus>

            @error('tenant_email_address')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control">

            @error('tenant_password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4 d-grid">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
        </div>
    </form>

    <p class="text-center">Don't have an account? <a href="{{ route('registerType') }}">Sign Up</a></p>

    <div class="modal fade" id="deactivatedModal" tabindex="-1" role="dialog" aria-labelledby="deactivatedModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deactivatedModalLabel">Account Deactivated</h5>
                </div>
                <div class="modal-body">
                    <p>Reason: {{ session('deactivated_reason') }}</p>
                    <p>Date: {{ session('deactivated_date') }}</p>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="pendingModal" tabindex="-1" role="dialog" aria-labelledby="pendingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deactivatedModalLabel">Account Pending</h5>
                </div>
                <div class="modal-body">
                    <p>Your account registration is still pending</p>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="rejectedModal" tabindex="-1" role="dialog" aria-labelledby="rejectedModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deactivatedModalLabel">Account Rejected</h5>
                </div>
                <div class="modal-body">
                    <p>Reason: {{ session('rejected_reason') }}</p>
                    <p>Date: {{ session('rejected_date') }}</p>
                </div>

            </div>
        </div>
    </div>
@endsection
