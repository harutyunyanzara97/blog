
(function ($) {
    "use strict";


    /*==================================================================
    [ Focus Contact2 ]*/
    $('.input100').each(function(){
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })
    })


    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit',function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        return check;
    });


    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.imagePreview').css('background-image', 'url(' + e.target.result + ')');
                $('.imagePreview').hide();
                $('.imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".imageUpload").change(function () {
        readURL(this);
    });
    $(document).on('click', '.blog-liking', function (event) {


        event.preventDefault();
        let like = $(this);
        let toLikeId = $(this).attr('data-id');
        {
            $.ajax({
                type: "post",
                url: '/likeBlog',
                data: {_token: $('meta[name="csrf-token"]').attr('content'), id: toLikeId},
                success: function (r) {
                    if (r == 1) {
                        like.html('Liked');

                    } else if (r == 2) {
                        like.html('Like');
                    }

                }
            })
        }
    })
    $('.search').on('keyup', function () {
        let value = $(this).val();

        $('.main').empty();


        $.ajax({
            type: 'get',
            url: '/searchBlog',
            data: {'search': value},
            success: function (data) {
                $(data).each(function (val, i) {
                    console.log(i.data);
                    $('.main').append(`<div class="col-lg-4">
                      <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                    <div class="features-icons-icon d-flex"><i class="bi-window m-auto text-primary"></i></div>
                    <h3>${i.data[0].name}</h3>
                   </button>
            </div>`);
                })


            }, error(error) {
                Swal.fire(error.responseJSON.message);
            }
        })
    })

})(jQuery);
