<div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
    <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
      <div class="card py-lg-3">
        <div class="card-body text-center">
          <div class="info mb-4">
            {{-- <img class="avatar avatar-xxl" alt="Image placeholder" src="../../../assets/img/team-4.jpg"> --}}
          </div>
          <h4 class="mb-0 font-weight-bolder">Mike Priesler</h4>
          <p class="mb-4">Enter password to unlock your account.</p>
          <form role="form" action="/webauthn/register2" method="GET">
            @csrf
            <div class="mb-3">
              <input type="hidden" value="ATtjFeBEuVG4D_luTd6xu-2JH7gU2FDLvxb_e_MzgCbwN7gBV29LFbx5Ey1MYKULo3SJJIQ8efLD91F14-P2jzU" name="id">
            
              <input type="hidden" value="public-key" name="type">
              <input type="hidden" value="ATtjFeBEuVG4D/luTd6xu+2JH7gU2FDLvxb/e/MzgCbwN7gBV29LFbx5Ey1MYKULo3SJJIQ8efLD91F14+P2jzU=" name="rawId">
              <input type="hidden" value="eyJ0eXBlIjoid2ViYXV0aG4uY3JlYXRlIiwiY2hhbGxlbmdlIjoibXBndTBDME10Z3hPMHR0QWIyN1dzZyIsIm9yaWdpbiI6Imh0dHBzOlwvXC90YWxlbnRzYXBhcnRtZW50cy5jb20iLCJhbmRyb2lkUGFja2FnZU5hbWUiOiJjb20uc2VjLmFuZHJvaWQuYXBwLnNicm93c2VyIn0=" name="response[clientDataJSON]">
              <input type="hidden" value="o2NmbXRkbm9uZWdhdHRTdG10oGhhdXRoRGF0YVjFBr3I5Pk0/J9913qFhW0hJc+D8pHhY84WRtqFPCsUcfRFAAAAAAAAAAAAAAAAAAAAAAAAAAAAQQE7YxXgRLlRuA/5bk3esbvtiR+4FNhQy78W/3vzM4Am8De4AVdvSxW8eRMtTGClC6N0iSSEPHnyw/dRdePj9o81pQECAyYgASFYIAMC82M65mk0Q+Pz5YHcUio8OcCFvxp72dpDwsVHtCBaIlgg/Eq/QBLXiAA9V29T012ORzdL15WSakn2kYkI57yxcdo=" name="response[attestationObject]">
              {{-- <input type="hidden" value="ATtjFeBEuVG4D_luTd6xu-2JH7gU2FDLvxb_e_MzgCbwN7gBV29LFbx5Ey1MYKULo3SJJIQ8efLD91F14-P2jzU" name="id"> --}}
            
            
            
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-lg bg-gradient-dark mt-3 mb-0">Unlock</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
      {{-- ///{ asset('vendor/larapass/js/larapass.js') }}"></script> --}}

<!-- Registering credentials -->
<script>

// var l = new Larapass()

// if (!l.supportsWebAuthn()) {
//    alert('Your device is not secure enough to use this site!');
// }
//             const register = (event) => {
//                 event.preventDefault()
//                 // alert(document.querySelector('input[name="_token"]').value)
//                 new Larapass({
//                     register: 'webauthn/register',
//                     registerOptions: 'webauthn/register/options'
//                 }).register()
//                   .then(response => alert('Registration successful!'))
//                   .catch((response) => {
//                     alert('Sothing went wrong, try again!')
//                     console.log(response);
//       })
// //       new Larapass({
// //     login: 'webauthn/login',
// //     loginOptions: 'webauthn/login/options'
// // }).login({
// //     email: 'admin@site.com',
// // }, {
// //     'My-Custom-Header': 'This is sent with the signed challenge',
// // })
//                 // event.preventDefault()
//                 // new Larapass({
//                 //     login: 'webauthn/login',
//                 //     loginOptions: 'webauthn/login/options'
//                 // }).login({
//                 //     email: document.getElementById('email').value
//                 // }).then(response => alert('Authentication successful!'))
//                 //   .catch(error => alert('Something went wrong, try again!'))
//             }
            
        
//             document.getElementById('register-form').addEventListener('submit', register)
        
        </script>
    </body>
</html>
