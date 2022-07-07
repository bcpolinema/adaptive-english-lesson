@extends('layout-admin') @section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <h1>Subject</h1>
        <div class="x_panel">
            <div class="x_title">
                <h2>Form Design <small>different form elements</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a class="collapse-link"
                            ><i class="fa fa-chevron-up"></i
                        ></a>
                    </li>
                    <li class="dropdown">
                        <a
                            href="#"
                            class="dropdown-toggle"
                            data-toggle="dropdown"
                            role="button"
                            aria-expanded="false"
                            ><i class="fa fa-wrench"></i
                        ></a>
                        <div
                            class="dropdown-menu"
                            aria-labelledby="dropdownMenuButton"
                        >
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li>
                        <a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form class="form-label-left input_mask">
                    <div class="col-md-6 col-sm-6 form-group has-feedback">
                        <input
                            type="text"
                            class="form-control has-feedback-left"
                            id="inputSuccess2"
                            placeholder="First Name"
                        />
                        <span
                            class="fa fa-user form-control-feedback left"
                            aria-hidden="true"
                        ></span>
                    </div>
                    <div class="col-md-6 col-sm-6 form-group has-feedback">
                        <input
                            type="text"
                            class="form-control"
                            id="inputSuccess3"
                            placeholder="Last Name"
                        />
                        <span
                            class="fa fa-user form-control-feedback right"
                            aria-hidden="true"
                        ></span>
                    </div>
                    <div class="col-md-6 col-sm-6 form-group has-feedback">
                        <input
                            type="email"
                            class="form-control has-feedback-left"
                            id="inputSuccess4"
                            placeholder="Email"
                        />
                        <span
                            class="fa fa-envelope form-control-feedback left"
                            aria-hidden="true"
                        ></span>
                    </div>
                    <div class="col-md-6 col-sm-6 form-group has-feedback">
                        <input
                            type="tel"
                            class="form-control"
                            id="inputSuccess5"
                            placeholder="Phone"
                        />
                        <span
                            class="fa fa-phone form-control-feedback right"
                            aria-hidden="true"
                        ></span>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3"
                            >Default Input</label
                        >
                        <div class="col-md-9 col-sm-9">
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Default Input"
                            />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3"
                            >Disabled Input
                        </label>
                        <div class="col-md-9 col-sm-9">
                            <input
                                type="text"
                                class="form-control"
                                disabled="disabled"
                                placeholder="Disabled Input"
                            />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3"
                            >Read-Only Input</label
                        >
                        <div class="col-md-9 col-sm-9">
                            <input
                                type="text"
                                class="form-control"
                                readonly="readonly"
                                placeholder="Read-Only Input"
                            />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3"
                            >Date Of Birth <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9">
                            <input
                                class="date-picker form-control"
                                placeholder="dd-mm-yyyy"
                                type="text"
                                required="required"
                                onfocus="this.type='date'"
                                onmouseover="this.type='date'"
                                onclick="this.type='date'"
                                onblur="this.type='text'"
                                onmouseout="timeFunctionLong(this)"
                            />
                            <script>
                                function timeFunctionLong(input) {
                                    setTimeout(function () {
                                        input.type = "text";
                                    }, 60000);
                                }
                            </script>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group row">
                        <div class="col-md-9 col-sm-9 offset-md-3">
                            <button type="button" class="btn btn-primary">
                                Cancel
                            </button>
                            <button class="btn btn-primary" type="reset">
                                Reset
                            </button>
                            <button type="submit" class="btn btn-success">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection @section('script')
<script>
    $(document).ready(function () {
        $("#add_topic").on("submit", function (e) {
            e.preventDefault();
            var form = this;
            $.ajax({
                url: $(form).attr("action"),
                method: $(form).attr("method"),
                data: new FormData(form),
                processData: false,
                dataType: "json",
                contentType: false,
                beforeSend: function () {
                    $(this).find("span.error-text").text("");
                },
                success: function (data) {
                    if (data.code == 0) {
                        $.each(data.error, function (prefix, val) {
                            $(form)
                                .find("span." + prefix + "_error")
                                .text(val[0]);
                        });
                    } else {
                        $(form)[0].reset();
                        alert(data.msg);
                    }
                },
            });
        });
    });
</script>
@endsection
