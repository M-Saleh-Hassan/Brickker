@extends('tashtebk.english.layouts.master')

@section('content')
<main class="gray relative" style="min-height: calc(100vh - 279.238px); padding-top: 121.719px;">
    <section class="product">
       <div class="container">
            <div class="row">

                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                        <h4 class="modal-title" id="myModalLabel">Reset Password</h4>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{route('password.update')}}">
                                @csrf
                                <input type="hidden" name="reset_token" value="{{$token}}">
                                <input type="password" name="new_password" class="form-control" placeholder="Your New Password" required>
                                <input type="password" name="new_password_confirm" class="form-control" placeholder="Repeat Your New Password" required>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn-home">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>


        </div>

    </section>
</main>
@endsection
