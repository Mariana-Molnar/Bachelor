(function($){

    $(document).ready(function() {

        console.log('Script main.js init');


        $('.hamburger-menu').on('click', function(e) {
            e.preventDefault();
            $(this).toggleClass('hamburger-menu_active');
            $('.mobile-menu').toggleClass('main-navigation-active');
        });

        let $filters_wrap = $('#project-filters-wrapper');

        const project_per_page = 4;
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
    });

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


})(jQuery);


