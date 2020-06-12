function __(text_key) {
    if (typeof(languages) === 'undefined') return text_key;
    if (languages[text_key]) {
        return languages[text_key];
    }

    return text_key;
}

function getQueryParam(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    let regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}


(function($){

    $(document).ready(function() {

        console.log('Script main.js init');

        let $filters_wrap = $('#project-filters-wrapper');

        const project_per_page = 3;
        let project_count = 6;
        if ($filters_wrap.length) {
            // project_name
            const project_machine_name = $filters_wrap.data('project_name');
            let $filters = $('#project-filters-wrapper .project-filter-checkbox');
            let $projects = $('#projects-wrapper .project-item-block');
            let $load_more_btn = $('#projects-load-more');

            $load_more_btn.click(function() {
                project_count += project_per_page;
                refresh_projects(show_classes, project_count);
            });

            let show_classes = [];
            if ($filters.length) {


                refresh_projects(show_classes, project_count);

                $filters.change(function() {

                    if ($(this).attr('id') === project_machine_name + '-type-all') {
                        $filters.prop('checked', $(this).prop('checked'));
                        show_classes = [];
                        if ($(this).prop('checked')) {
                            for (let i=0; i<$filters.length;i++) {
                                if (project_machine_name + '-type-all' === $filters.get(i).id) continue;
                                show_classes.push($filters.get(i).id);
                            }
                        }
                    } else {
                        if ($(this).prop('checked')) {
                            show_classes.push($(this).attr('id'))
                        } else {
                            if (show_classes.indexOf($(this).attr('id'))>=0) {
                                show_classes.splice(show_classes.indexOf($(this).attr('id')),1);
                            }
                        }
                        $filters.filter('#' + project_machine_name + '-type-all').prop('checked',false);
                    }

                    refresh_projects(show_classes, project_count);

                });
            }
        }

        function refresh_projects(show_classes, projects_count) {
            let $projects = $('#projects-wrapper .project-item-block');
            let $load_more_btn = $('#projects-load-more');

            if (show_classes.length === 0) {
                $projects.addClass('filter-show')
            } else {
                $projects.removeClass('filter-show');
                for (let i in show_classes) {
                    $projects.filter('.' + show_classes[i]).addClass('filter-show')
                }
            }

            $projects.hide().addClass('filter-hide');
            var count = 0;
            $projects.filter('.filter-show').removeClass('filter-hide').each(function() {
                if (count >= projects_count) return;
                $(this).show();
                let el = $(this);
                setTimeout(function() {
                    el.css({
                        'opacity': 1,
                        'width': '380px'
                    })
                },50);
                count++;
            });

            $projects.filter('.filter-hide').css({
                'opacity': 0,
                'width': 0
            });



            if ($projects.filter('.filter-show').length === $projects.filter(':visible').length) {
                $load_more_btn.hide();
            } else {
                $load_more_btn.show();
            }
        }

        $('#datetimepicker').datetimepicker();

        $('.hamburger-menu').on('click', function(e) {
            e.preventDefault();
            $(this).toggleClass('hamburger-menu_active');
            $('.mobile-menu').toggleClass('main-navigation-active');
        });

        // $('.show-more-button').on('click', function() {
        //     $(this).closest('.tariff-block').toggleClass('tariff-block-active');
        // });

        $('.show-more-button').on('click', function(){

            if ($(this).closest('.tariff-block').hasClass('tariff-block-active')) {
                $(this).closest('.tariff-block').find('.additional-information-block').slideUp(400);
                $(this).closest('.tariff-block').removeClass('tariff-block-active');
            }
            else {
                $(this).closest('.tariff-block').toggleClass('tariff-block-active');
                $('.tariff-block-active .additional-information-block').slideDown(400);
            }
        });

        let $answer = $('.faq-answer');

        $('.faq-item').on('click', function(){

            if ($('.faq-answer',this).hasClass('show')) {
                $('.faq-answer',this).removeClass('show');
                $('.faq-answer',this).slideUp(350);
            } else {
                $answer.removeClass('show');
                $answer.slideUp(350);
                $('.faq-answer',this).toggleClass('show');
                $('.faq-answer',this).slideToggle(350);
            }
        });


        $('.scroll-logo-block').on('click', function() {
            let $target = $('.association-block');
            if ($target.length) {
                $('html,body').animate({scrollTop: $target.offset().top},'500');
            }
        });

        let $tariff_block = $('.tariff-types-block-wrap');
        if ($tariff_block.length >0) {
            $tariff_block.slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                arrows: false,
                responsive: [
                    {
                        breakpoint: 991, // tablet breakpoint
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 768, // mobile breakpoint
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        }


        $('.form-phone-for-call').on('submit', function(event) {
            event.preventDefault();
            event.stopPropagation();
            let form = this;
            if (form.checkValidity() !== false) {
                let ajax_data = {
                    'action': 'save_phone_for_call',
                    'phone': $(form).find('.phone-number-input').val(),
                    'date' : $(form).find('.datetime-input').val()
                };

                $.ajax({
                    type: "POST",
                    url: variables.ajaxurl,
                    data: ajax_data,
                    dataType: 'json',
                    beforeSend: function () {

                    },
                    complete: function() {

                    },
                    success: function(data) {
                        if (data.success) {
                            $(form).closest('.modal').find('.close').click();
                        } else {
                            console.log(data.error);
                        }
                    },
                    error: function() {
                        console.log('Ajax Error');
                    }
                });

                console.log(data);
            }
        });


        $('.contract-form-link').on('click', function(e) {
            e.preventDefault();

            let href = $(this).attr('href');

            let tariff = $(this).data('tariff');

            let ajax_data= {
                action: 'save_tariff',
                tariff: tariff
            };

            $.ajax({
                type: "POST",
                url: variables.ajaxurl,
                data: ajax_data,
                dataType: 'json',
                beforeSend: function () {

                },
                complete: function() {

                },
                success: function(data) {
                    console.log(data);
                    if (data.success) {
                        window.location.href = href;
                    } else {
                        console.log(data.error);
                    }
                },
                error: function() {
                    console.log('Ajax Error');
                }
            });

            return false;
        });

        document.addEventListener('mup.shown-page', function(e) {
           let parent = $('.contract-form-block');
           if (parent.length) {
               let plz = parent.data('plz');
               let city = parent.data('city');

               let plz_input = $('#id-60');
               let city_input = $('#id-57');

               if (plz_input.length && plz) {
                   plz_input.val(plz).prop('disabled',true)
               }

               if (city_input.length && city) {
                   city_input.val(city).prop('disabled',true)
               }

           }
        });


    });

    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

})(jQuery);


