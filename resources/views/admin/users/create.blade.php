@extends('layouts.app') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create User') }}</div>
                <div id="card-body" class="card-body">

                    <form id="create-user-form" method="POST" action="{{ route('user.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"> 
                                @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"> 
                                @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"> 
                                @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="form-submit-button" type="submit" class="btn btn-primary">
                                    {{ __('Create user') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop 

@section('scripts')
{{--  AJAX form validation  --}}
<script>
    (function () {
        document.querySelector('#create-user-form').addEventListener('submit', function (e) {
            e.preventDefault()
            axios.post(this.action, {
                'name': document.querySelector('#name').value,
                'email': document.querySelector('#email').value,
                'password': document.querySelector('#password').value,
                'password_confirmation': document.querySelector('#password-confirm').value
            })
            .then((response) => {
                // window.location.href = '{{ route('user.create') }}'
                clearErrors()
                this.reset()
                var cardBody = document.getElementById('card-body')
                cardBody.insertAdjacentHTML('afterbegin', '<div class="alert alert-success" id="success">User created successfully!</div>')
                document.getElementById('success').scrollIntoView()
            })
            .catch((error) => {
                const errors = error.response.data.errors
                const firstItem = Object.keys(errors)[0]
                const firstItemDOM = document.getElementById(firstItem)
                const firstErrorMessage = errors[firstItem][0]
                // Scroll to the error message
                firstItemDOM.scrollIntoView()
                clearErrors()
                // Show the error message
                firstItemDOM.insertAdjacentHTML('afterend', `<div class="text-danger">${firstErrorMessage}</div>`)
                // Highlight the form control with the error
                firstItemDOM.classList.add('border', 'border-danger')
            });
        });
        function clearErrors() {
            // Remove all error messages
            const errorMessages = document.querySelectorAll('.text-danger')
            errorMessages.forEach((element) => element.textContent = '')
            // Remove all form controls with highlighted error text box
            const formControls = document.querySelectorAll('.form-control')
            formControls.forEach((element) => element.classList.remove('border', 'border-danger'))
        }
    })();
</script>
@stop