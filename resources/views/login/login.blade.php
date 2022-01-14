<div class="row justify-content-center">
    <div class="col-3">
        <div class="auth-box">
            <div id="loginform">
                <div class="text-center pt-3 pb-3">
                    <span class="db"><img class="w-25" src="{{url('img/logo_hotelmanager.png')}}" alt="logo"></span>
                    <h1>Hotel Manager</h1>
                </div>
                <!-- Form -->
                <form class="form-horizontal mt-3" id="loginform" action="index.html">
                    <div class="row pb-4">
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                      <span class="input-group-text bg-success text-white h-100" id="basic-addon1">
                          <i class="mdi mdi-account fs-4"></i></span>
                            </div>
                                <input
                                    type="text"
                                    class="form-control form-control-lg"
                                    placeholder="Escriba su nombre de usuario"
                                    aria-label="Username"
                                    aria-describedby="basic-addon1"
                                    required=""
                                />
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                      <span
                          class="input-group-text bg-warning text-white h-100"
                          id="basic-addon2"
                      ><i class="mdi mdi-lock fs-4"></i
                          ></span>
                                </div>
                                <input
                                    type="text"
                                    class="form-control form-control-lg"
                                    placeholder="Escriba su contraseña"
                                    aria-label="Password"
                                    aria-describedby="basic-addon1"
                                    required=""
                                />
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <div class="d-grid gap-2">
                                <button class="btn btn-success text-white" type="submit">
                                    Acceder
                                </button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
