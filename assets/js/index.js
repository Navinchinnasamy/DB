//== Class definition
var g_iterations = 0, loopInterval = null, finishedCount = 0, g_offset = 0;
var pbar = {};

var Index = function () {

    var altDate = function (value) {
        var diff = Date.now() - new Date(value);

        /**
         * If in a hour
         * e.g. "2 minutes ago"
         */
        if (diff < (60 * 60 * 1000)) {
            return moment(value).fromNow();
        }
        /*
         * If in the day
         * e.g. "11:23"
         */
        else if (diff < (60 * 60 * 24 * 1000)) {
            return moment(value).format('HH:mm');
        }
        /*
         * If in week
         * e.g "Tuesday"
         */
        else if (diff < (60 * 60 * 24 * 7 * 1000)) {
            return moment(value).format('dddd');
        }
        /*
         * If more than a week
         * e.g. 03/29/2016
         */
        else {
            return moment(value).calendar();
        }
    };

    var wizard = function () {
        $('#exampleValidator').wizard({
            buttonLabels: {
                next: 'Next',
                back: 'Previous',
                finish: 'Finish'
            },
            templates: {
                buttons: function () {
                    const options = this.options;
                    var id = $(this).attr('id');
                    return '<div class="wizard-buttons"><a class="btn m-btn--pill btn-secondary m-btn m-btn--hover-brand m-btn--custom" href="#' + id + '" data-wizard="back" role="button">' + options.buttonLabels.back + '</a><a class="btn m-btn--pill btn-secondary m-btn m-btn--hover-brand m-btn--custom" href="#' + id + '" data-wizard="next" role="button">' + options.buttonLabels.next + '</a><a class="wizard-finish btn m-btn--pill btn-secondary m-btn m-btn--hover-brand m-btn--custom" href="#' + id + '" data-wizard="finish" role="button">' + options.buttonLabels.finish + '</a></div>';
                }
            },
            onInit: function () {
                $('#validation').formValidation({
                    framework: 'bootstrap',
                    buttonsAppendTo: 'this',
                    fields: {
                        dbtype1: {
                            validators: {
                                notEmpty: {
                                    message: 'Database Type is required'
                                }
                            }
                        }, host1: {
                            validators: {
                                notEmpty: {
                                    message: 'Without host we can\'t fetch'
                                }
                            }
                        }, port1: {
                            validators: {
                                notEmpty: {
                                    message: 'Please tell me the Port'
                                }
                            }
                        }, database1: {
                            validators: {
                                notEmpty: {
                                    message: 'Let me know the database to be fetched'
                                }
                            }
                        }, username1: {
                            validators: {
                                notEmpty: {
                                    message: 'The username is required'
                                }
                            }
                        }, password1: {
                            validators: {
                                notEmpty: {
                                    message: 'Password please'
                                }
                            }
                        }, dbtype2: {
                            validators: {
                                notEmpty: {
                                    message: 'Database Type is required'
                                }
                            }
                        }, host2: {
                            validators: {
                                notEmpty: {
                                    message: 'Without host we can\'t fetch'
                                }
                            }
                        }, port2: {
                            validators: {
                                notEmpty: {
                                    message: 'Please tell me the Port'
                                }
                            }
                        }, database2: {
                            validators: {
                                notEmpty: {
                                    message: 'Let me know the database to be inserted'
                                }
                            }
                        }, username2: {
                            validators: {
                                notEmpty: {
                                    message: 'The username is required'
                                }
                            }
                        }, password2: {
                            validators: {
                                notEmpty: {
                                    message: 'Password please'
                                }
                            }
                        }, table: {
                            validators: {
                                notEmpty: {
                                    message: 'Table name is required'
                                }
                            }
                        }, column: {
                            validators: {
                                notEmpty: {
                                    message: 'Please set primary column of the table'
                                }
                            }
                        }, count: {
                            validators: {
                                notEmpty: {
                                    message: 'How much column you want?'
                                }
                            }
                        }, order: {
                            validators: {
                                notEmpty: {
                                    message: 'In which order you want the records?'
                                }
                            }
                        }, iterations: {
                            validators: {
                                notEmpty: {
                                    message: 'How many time you want me to run?'
                                }
                            }
                        }, interval: {
                            validators: {
                                notEmpty: {
                                    message: 'What is the time interval to run in loop?'
                                }
                            }
                        }
                    }
                });

            },
            validator: function () {
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
            onFinish: function () {
                // $('#validation').submit();

                var data = {};
                $.each($("#exampleValidator").find("input,select"), function (i, d) {
                    var id = $(d).attr('id');
                    id = id.split('_');
                    if (id[1]) {
                        if (!data[id[0]]) {
                            data[id[0]] = {};
                        }
                        data[id[0]][id[1]] = $(d).val();
                    } else {
                        data[id[0]] = $(d).val();
                    }
                });
                Index.insert_records(data);
            }
        });

        $('#exampleValidator').on('wizard::afterChange', function (e, a, b, c) {
            var t = $($(c)[0].$element).find('a').attr('current_ind');
            switch (t) {
                case '1':
                    $('#main_title').text("Database 1");
                    $('#sub_title').text("[Fetch] Credentials");
                    break;
                case '2':
                    $('#main_title').text("Database 2");
                    $('#sub_title').text("[Insert] Credentials");
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

        },
        progressBar = function () {
            var pbar = $('#progress-basic').progressbarManager({
                totalValue: 100,
                animate: true,
                currentValue: 0,
                stripe: true
            });
            return pbar;
        },
        insert_records = function (data) {
            finishedCount = 0;
            g_iterations = 0;
            g_iterations = (data.iterations) ? data.iterations : 1;
            $("#exampleValidator").hide();
            $(".process_running").show();
            data.offset = g_offset;
            func_iterations(data);
            var loop_interval = (data.interval) ? data.interval : 60;
            loopInterval = setInterval(function () {
                data.offset = g_offset;
                func_iterations(data)
            }, loop_interval * 1000);
        },
        func_iterations = function (data) {
            if (g_iterations > 0) {
                var url = (data.reqfor && data.reqfor == "delete") ? 'delete_sleep.php' : 'insert_sleep.php';
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    success: function (ret) {
                        try {
                            $("body").find("#finished").html(++finishedCount);
                            ret = JSON.parse(ret);
                            if (ret.status == "failed") {
                                // $("body").find("#result_from_query ol").append('<li style="color: red; font-weight: bold;">'+ret.msg+'</li>');
                                $("body").find(".m-list-timeline__items").append('<div class="m-list-timeline__item"> <span class="m-list-timeline__badge m-list-timeline__badge--danger"></span> <span class="m-list-timeline__text"> ' + ret.msg + ' </span> <span class="m-list-timeline__time"> ' + altDate(new Date()) + ' </span> </div>');
                            } else {
                                // $("body").find("#result_from_query ol").append('<li>'+ret.msg+'</li>');
                                $("body").find(".m-list-timeline__items").append('<div class="m-list-timeline__item"> <span class="m-list-timeline__badge m-list-timeline__badge--info"></span> <span class="m-list-timeline__text"> ' + ret.msg + ' </span> <span class="m-list-timeline__time"> ' + altDate(new Date()) + ' </span> </div>');
                            }
                        } catch (err) {
                            $(".process_running").hide();
                            $("#exampleValidator").show();
                            // $("body").find("#result_from_query ol").append('<li style="color: red; font-weight: bold;">'+ret.msg+'</li>');
                            $("body").find(".m-list-timeline__items").append('<div class="m-list-timeline__item"> <span class="m-list-timeline__badge m-list-timeline__badge--danger"></span> <span class="m-list-timeline__text"> ' + ret.msg + ' </span> <span class="m-list-timeline__time"> ' + altDate(new Date()) + ' </span> </div>');
                            clearInterval(loopInterval);
                        }
                    }
                });
                g_iterations -= 1;
                g_offset = parseInt(g_offset) + parseInt(data.count);

                var perc = ((finishedCount / data.iterations) * 100);
                perc = Math.round(perc);
                pbar.setValue(perc);
            } else {
                $(".process_running").hide();
                $("#exampleValidator").show();
                $("body").find(".m-list-timeline__items").append('<div class="m-list-timeline__item"> <span class="m-list-timeline__badge m-list-timeline__badge--success"></span> <span class="m-list-timeline__text"> Completed </span> <span class="m-list-timeline__time"> ' + new Date() + ' </span> </div>');
                clearInterval(loopInterval);
            }
        };

    return {
        init: function () {
            wizard();
        },
        progressBar: function () {
            return progressBar();
        },
        insert_records: function (data) {
            insert_records(data);
        }
    };
}();

$(window).on("unload", function (e) {
    $.each($("#exampleValidator").find("input,select"), function (i, d) {
        var id = $(d).attr('id');
        sessionStorage.setItem(id, $(d).val());
    });
});

$(window).on("load", function (e) {
    $.each($("#exampleValidator").find("input,select"), function (i, d) {
        var id = $(d).attr('id');
        var val = sessionStorage.getItem(id);
        if (val) {
            $(d).val(val);
        }
    });
});

//== Class initialization on page load
jQuery(document).ready(function () {
    Index.init();
    pbar = Index.progressBar();
});