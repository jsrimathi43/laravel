  <div class="email-template-container">
    <div class="email-template-body">
            <div class="email-template-content">
              <div class="email-template-content-head">
                <h2>hello!</h2>
                <p>You are receiving this email because we received a password reset request for your account.</p>
              </div>
                <div class="email-template-content-button"><a href = "{{ route('password.reset', $token) }}">Reset Password</a></div>
                <div class="email-template-content-info">
                  <div class="email-template-content-info-container">
                    <p>This password reset link will expire in 60 minutes.</p>
                    <p>If you did not request a password reset, no further action is required.</p>
                    <p>Regards, <br>Laravel</p>
                  </div>
                  <div class="hr"></div>
                        <div class="email-template-content-info-link">
                          <p>If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser: <a href = "{{ route('password.reset', $token) }}">Reset Password</a> </p>
                        </div>
                  </div>
            </div>
    </div>
</div>
<link rel="stylesheet" type="text/css" href="{{ asset('css/scss/newStyle.css') }}" >
