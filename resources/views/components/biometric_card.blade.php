<div class="card mt-8">
    <div class="card-body text-center">
        <div class="info mb-4">
            <img class="avatar avatar-xxl" alt="Image placeholder" id="user-image"
                src="{{asset('assets/img/no-pics-placeholder.jpg') }}">
        </div>
        <span class="opacity-4"> Welcome Back </span>
        <h4 class="mb-0">  <span class="font-weight-bolder" id="user-name">User Name </span> </h4>
        <p class="mb-4">Use your finger print or authenticated device to login.</p>
        <form role="form">
            <div class="mb-3 text-center">
                <a href="#" class="avatar avatar-lg rounded-circle border border-dark" id="finger-print-image">
                    <img alt="Image placeholder" class="p-1" src="{{asset('assets/img/fingerprint-ionic-authentication-android-computer-icons-png-favpng-44g6nMFmJ8dfbmJAeEAeZ6SWp.jpg') }}">
                  </a>
            </div>
            <div class="text-center mb-2">
                <button type="button"
                    class="btn btn-lg bg-gradient-dark mt-3 mb-0" id="auth-button">Authenticate</button>
            </div>
            <div class="mb-2 position-relative text-center">
                <p class="text-sm font-weight-bold mb-2 text-secondary text-border d-inline z-index-2 bg-white px-3">
                  or
                </p>
              </div>
              <div class="text-center">
                <a class="btn btn-link" href="#" id="logout">Logout</a>
              </div>

        </form>
    </div>
</div>