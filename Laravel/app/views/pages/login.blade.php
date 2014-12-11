<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <!-- CSS files -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/css/bootstrapValidator.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/fontawesome/4.1.0/css/font-awesome.min.css" />

    <!-- JS files -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>
  
    <!-- Bootstrap validator -->
    <script>
        $(document).ready(function() {
            $('#loginForm').bootstrapValidator({
                message: 'This value is not valid',
                fields: {
                	 username: {
                         message: 'The username is not valid',
                         validators: {
                             notEmpty: {
                                 message: 'The username is required and cannot be empty'
                             },
                             stringLength: {
                                 min: 6,
                                 max: 45,
                                 message: 'The username must be more than 6 and less than 45 characters long'
                             },
                             regexp: {
                                 regexp: /^[a-zA-Z0-9]+$/,
                                 message: 'The username can only consist of alphabetical and number'
                             }
                         }
                    },
                     password: {
                        validators: {
                            notEmpty: {
                                message: 'The password is required and cannot be empty'
                            }
                        }
                    }
                }
            });
        });
    </script>
    
  </head>
  
  <body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <h2>Login</h2>
                </div>
                
                <form id="loginForm" role="form" method="POST" class="form-horizontal" action="{{ route('handle.login') }}">
                	<ul class="errors">
                	<?php 
	                	if (isset($msg))
	                	{
	                		echo '<li>'.$msg.'</li>';
	                	}
                	?>
				    @foreach($errors->all() as $message)
				        <li>{{ $message }}</li>
				    @endforeach
				    </ul>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="email">Username</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" />
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="password">Password</label>
                        <div class="col-sm-5">
                            <input type="password" class="form-control" id="password" name="password" />
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-3">
                            <div class="checkbox">
                                <label><input type="checkbox" id="remember_me" name="remember_me" value="yes"/> Remember me</label>
                            </div>
                        </div>
                    </div>
                    
                    {{ Form::token() }}
                    
                    <div class="form-group">
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-default">Login</button>
                            <button class="btn btn-danger" onclick="window.location.href='{{ route('users.create') }}'">Register</button>
                        </div>
                    </div>
                </form>
                
            </div>   
        </div>
    </div>
  </body>
  
</html>