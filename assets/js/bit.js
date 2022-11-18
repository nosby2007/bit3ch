$(function(){
	var nbreVisit, modal = new bootstrap.Modal($('.modal').get(0));
    var bit = {
        status: 0,
        ctrl_modal: true,
        init: function(){
            var ratio = screen.width > 768 ? .25 : .1,
            options = {
                root: null,
                rootMargin: '0px',
                threshold: ratio
            },
            handleIntersect = function(entries, observer) {
                entries.forEach(entry => {
                    if(entry.intersectionRatio > ratio){
                        entry.target.classList.add('shape-observe-visible');
                        observer.unobserve(entry.target);
                    }
                    
                });
            },

            observer = new IntersectionObserver(handleIntersect, options);
            $('.shape-observe').each(function(){
                observer.observe(this);
            }); 

            bit._window.init();

            $('.modal').on({
                'shown.bs.modal': function(){
                    $('.newsletter-modal .form-newsletter').find('.form-control').focus();
                    bit.ctrl_modal = false;
                },
                'hidden.bs.modal': function(){
                    if(bit.status)
                        bit.toast($('.cookies-toast').get(0), false);
                }
            });

            $('.form-newsletter').each(function(ind){
                var form = this;
                $(this).find(':submit').click(function(e){
                    var email = $(form).find(':input').val(), ctrl = true;
    
                    e = e || window.event;
                    e.preventDefault();
                    
                    if(email){
                        if(!/^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/.test(email)){
                            $(form).find('input').addClass('is-invalid');
                            if(ind)
                                $(this).next('div').show('fade', 'fast');
                            ctrl = false;
                        }
                        
                        if(ctrl){ 
                            $(form).find('.form-control').addClass('is-valid').removeClass('is-invalid');
                            if(ind)
                                $(this).removeClass('bi-envelope');
                            $(this).prop('disabled', true).append('<span class="spinner-border spinner-border-sm ms-2"></span>')
                            .next('div').hide('fade', 'fast');
                            bit.ajaxRequest('server/server.php?do=newsletter', 'POST', form, ind);
                        }
                    }
                });
            });

            $('.cookies-toast :button').each(function(ind){
                $(this).click(function(){
                    var toast = new bootstrap.Toast($('.cookies-toast').get(0));
                        opt = ind == 1 ? 'all' : 'default';
                     bit.ajaxRequest('server/server.php?do=cookie-preference&option=' + encodeURIComponent(opt));
                     toast.hide()
                });
            });

            var tooltip;
            
            $('.sticky-link .nav-link').click(function(e){
                var title = $(this).attr('aria-label'),
                    href = $(this).attr('href');
                e = e || window.event;

                if(!$(this).attr('href')){
                    e.preventDefault();
                    $(window).scrollTop(0);
                }else
                    location.reload();
                bootstrap.Tooltip.getOrCreateInstance(this).hide();
            });

            window.onunload = function(){
                alert('ok');
            };
            
        },
        _window: {
            wScroll: 0,
            headerHeight: $('header').innerHeight(),
            html: null,
            init: function(){

                var tab = [];
                $(window).on({
                    'load': function(){
                        bit._window.load();
                    },
                    'scroll': function(){ 
                        bit._window.scroll();
                    },
                    'resize': function(){
                        $('.top-header>ul>li:lt(3)').each(function(ind){ 
                            link = this.firstChild;
                            if(window.innerWidth <= 768){
                                if(link.lastChild.nodeType === 3){
                                    tab.push(link.removeChild(link.lastChild));
                                    $(this).addClass('nav-item-sm');
                                }
                            }else if(tab.length){
                                $(this).removeClass('nav-item-sm');
                                link.appendChild(tab[ind]);
                                if(ind == 3)
                                    tab = [];
                            }
                        });
                    }
                });

                $('.menu .navbar-nav>li').not(':last').hover(function(){
                    var l = window.innerWidth >= 992 ? '90%' : '100%';
                    if(!$(this).children().hasClass('on')){
                        $(this).append('<span class="nav-item-hover"></span>');
                        $(this).find('>span').stop().animate({width: l}, 'slow', 'easeOutSine');
                    }
                },
                function(){
                    $(this).find('>span').stop().animate({width: 0}, 'slow', 'easeOutSine',  function(){
                        $(this).remove();
                    });
                });
            },

            load: function(){
                var url = window.location.href,
                    tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')),
                    tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                        return new bootstrap.Tooltip(tooltipTriggerEl)
                    }), page = url.substring(url.lastIndexOf('/') + 1), i = 0;
                
                bit.ajaxRequest('server/server.php?do=load-page&item=0');
                $(window).trigger('scroll');
                $(window).trigger('resize');

                $('.menu .navbar-nav a').each(function(ind){
                    if(~url.indexOf($(this).attr('href')))
                        i = ind > 1 && ind < 6 ? 1 : ind; 
                });

                $('.menu .navbar-nav a:eq(' + i + ')').addClass('on');
                $('.preloader').remove();
            },

            scroll: function(){
                if(window.pageYOffset >= bit._window.headerHeight){
                    if(!$('.header-site').hasClass('header-scrolling')){
                        $('.header-site').addClass('header-scrolling')
                        .next('section').find('.sticky-link').stop().show('slide', 'fast', function(){
                            $(this).css('display', 'flex');
                        });
                    }

                }else{
                    if($('.header-site').hasClass('header-scrolling')){
                        $('.header-site').removeClass('header-scrolling')
                        .next('section').find('.sticky-link').stop().hide('slide', 'fast');
                    }
                }
            }
        },                                                                

        feedback: function(resp, n){
            switch(n){
                case 0: 
                    $('.modal-newsletter :submit').prop('disabled', false).find('.spinner-border').remove();
                    modal.hide();
                    break;
                
                case 1:
                    var toast = new bootstrap.Toast($('footer .toast').get(0), {
                            delay: 5000
                        });

                    if(resp.status){
                        $('footer .form-newsletter').find('.form-control').removeClass('is-valid').val('')
                        .next(':button').addClass('bi-send').prop('disabled', false).empty();
                        toast.show();   
                    }
                                
                    break;
                default:
                    if(resp.status == 200){
                        $.map(resp.response, function(elt, ind){
                            if(ind == 0 && elt.verify_visit == 0){
                                if(elt.newsletter_status)
                                    modal.show();
                                
                                bit.status = elt.cookie_status;
                                if(bit.ctrl_modal)
                                    bit.toast($('.cookies-toast').get(0), false);
                            }
                            return true;
                        });
                           
                    }
            }
        },

        ajaxRequest: function(url, method = 'GET', form = null, n = null){
            var xhr = new XMLHttpRequest,
                formData = form == null ? null : new FormData(form);
            
            xhr.open(method, url);
            xhr.send(formData);
            xhr.onreadystatechange = function(){
                if(xhr.readyState == xhr.DONE && xhr.status == 200){
                    bit.feedback(JSON.parse(xhr.responseText), n);
                }else if(xhr.readyState == xhr.DONE && xhr.status != 200){
                    xhr.abort();
                }
            };
        },

        toast: function(elt, autoHide = true){
            var toast = new bootstrap.Toast(elt, {
                autohide: autoHide
            });
            toast.show(); 
        }



    };
    bit.init();

	var tab_elt = [], h = Math.floor(parseInt($('header').height()));

    $('header>div:first .nav-link').each(function(ind){
        $(this).hover(function(){
                tooltip = new bootstrap.Tooltip(this, {});
                tooltip.show();
            },
            function(){
                tooltip.hide();
            }
        );
    });

    
});