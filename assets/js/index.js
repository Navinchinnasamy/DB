//== Class definition
var Index = function () {

    var wizard = function () {
        $('#exampleValidator').wizard({
            buttonLabels: {
                next  : 'Next',
                back  : 'Prevoius',
                finish: 'Finish'
            },
            templates   : {
                buttons: function () {
                    const options = this.options;
                    var id = $(this).attr('id');
                    return '<div class="wizard-buttons"><a class="btn m-btn--pill btn-secondary m-btn m-btn--hover-brand m-btn--custom" href="#' + id + '" data-wizard="back" role="button">' + options.buttonLabels.back + '</a><a class="btn m-btn--pill btn-secondary m-btn m-btn--hover-brand m-btn--custom" href="#' + id + '" data-wizard="next" role="button">' + options.buttonLabels.next + '</a><a class="wizard-finish btn m-btn--pill btn-secondary m-btn m-btn--hover-brand m-btn--custom" href="#' + id + '" data-wizard="finish" role="button">' + options.buttonLabels.finish + '</a></div>';
                }
            },
            onInit      : function () {
                $('#validation').formValidation({
                    framework      : 'bootstrap',
                    buttonsAppendTo: 'this',
                    fields         : {
                        dbtype1      : {
                            validators: {
                                notEmpty: {
                                    message: 'The username is required'
                                }
                            }
                        }, host1     : {
                            validators: {
                                notEmpty: {
                                    message: 'The username is required'
                                }
                            }
                        }, port1     : {
                            validators: {
                                notEmpty: {
                                    message: 'The username is required'
                                }
                            }
                        }, database1 : {
                            validators: {
                                notEmpty: {
                                    message: 'The username is required'
                                }
                            }
                        }, username1 : {
                            validators: {
                                notEmpty: {
                                    message: 'The username is required'
                                }
                            }
                        }, password1 : {
                            validators: {
                                notEmpty: {
                                    message: 'The username is required'
                                }
                            }
                        }, dbtype2   : {
                            validators: {
                                notEmpty: {
                                    message: 'The username is required'
                                }
                            }
                        }, host2     : {
                            validators: {
                                notEmpty: {
                                    message: 'The username is required'
                                }
                            }
                        }, port2     : {
                            validators: {
                                notEmpty: {
                                    message: 'The username is required'
                                }
                            }
                        }, database2 : {
                            validators: {
                                notEmpty: {
                                    message: 'The username is required'
                                }
                            }
                        }, username2 : {
                            validators: {
                                notEmpty: {
                                    message: 'The username is required'
                                }
                            }
                        }, password2 : {
                            validators: {
                                notEmpty: {
                                    message: 'The username is required'
                                }
                            }
                        }, table     : {
                            validators: {
                                notEmpty: {
                                    message: 'The username is required'
                                }
                            }
                        }, column    : {
                            validators: {
                                notEmpty: {
                                    message: 'The username is required'
                                }
                            }
                        }, count     : {
                            validators: {
                                notEmpty: {
                                    message: 'The username is required'
                                }
                            }
                        }, order     : {
                            validators: {
                                notEmpty: {
                                    message: 'The username is required'
                                }
                            }
                        }, iterations: {
                            validators: {
                                notEmpty: {
                                    message: 'The username is required'
                                }
                            }
                        }, interval  : {
                            validators: {
                                notEmpty: {
                                    message: 'The username is required'
                                }
                            }
                        }
                    }
                });

            },
            validator   : function () {
                var fv = $('#validation').data('formValidation');
                var $this = $(this);
                // Validate the container
                fv.validateContainer($this);
                var isValidStep = fv.isValidContainer($this);
                if (isValidStep === false || isValidStep === null) {
                    return false;
                }
                return true;
            },
            onFinish    : function () {
                $('#validation').submit();
                alert('finish');

                var data = {};
                $.each($("#exampleValidator").find("input,select"), function(i, d){
                    var id = $(d).attr('id');
                    id = id.split('_');
                    if(id[1]){
                        if(!data[id[0]]){
                            data[id[0]] = {};
                        }
                        data[id[0]][id[1]] = $(d).val();
                    } else{
                        data[id[0]] = $(d).val();
                    }
                });

                console.log(data)

            }
        });

        $('#exampleValidator').on('wizard::afterChange', function (e, a, b, c) {
            var t = $($(c)[ 0 ].$element).find('a').attr('current_ind');
            switch (t) {
                case '1':
                    $('#main_title').text("Database 1");
                    $('#sub_title').text("[Fetch] Credentialas");
                    break;
                case '2':
                    $('#main_title').text("Database 2");
                    $('#sub_title').text("[Insert] Credentialas");
                    break;
                case '3':
                    $('#main_title').text("Table Details");
                    $('#sub_title').text("1");
                    break;
                case '4':
                    $('#main_title').text("Iteration Details");
                    $('#sub_title').text("2");
                    break;
            }


        });

    }


    return {
        init: function () {
            wizard();
        }
    };
}();

//== Class initialization on page load
jQuery(document).ready(function () {
    Index.init();
});