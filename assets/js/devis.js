$(function(){
    var pg = 0, myToast = document.querySelector('.toast-feedback'),
        toast = new bootstrap.Toast(myToast, {
            delay: 3000
        });
    $(window).load(function(){
        $.ajax({
			url: 'server/server.php',
            dataType: 'json',
            data:{
                do: 'load-page',
                item: 0
            },
            success: function(data){
                
                if(data.status == 200){ 
                    $.map(data.response, function(elt, index){
                        var form = $('.section-devis .form:eq(0)').get(0), value, html = ''; 
                        if(index){
                            for(var id in elt){
                                value = elt[id];
                                $(form).find(':input[name="' + id + '"]').val(value);
                            }  
                        }else{
                            pg = typeof elt.item === 'undefined' ? 0 : elt.item;
                            $('.section-devis .tab-content>div:eq(' + pg + ')').addClass('show').addClass('active');
                            $('.section-devis .nav-link').each(function(ind){
                                if(ind <= elt.item)
                                    $(this).prop('disabled', false);
                            });
                        }
                        $('.section-devis .nav-link:eq(' + pg + ')').addClass('active');
                        
                        return null;
                    });
                    $('.summary .card-body').summary(data.response);
                }
            }
        });
    });

    $('.section-devis .nav-tabs .nav-item').each(function(ind){
        $(this).on({
            click: function(){
                if(!this.firstChild.disabled){
                    $('.section-devis .tab-content>div:eq(' + pg + ')').removeClass('show').removeClass('active');
                    $.ajax({
                        url: 'server/server.php',
                        dataType: 'json',
                        data: {
                            do: 'update-page',
                            item: ind
                        },
                        success: function(data){ 
                            if(data.status){
                                pg = data.item;
                                $('.section-devis .tab-content>div:eq(' + pg + ')').addClass('show').addClass('active'); 
                            }
                        }
                    });
                }
            }
        });
    });

    myToast.addEventListener('hidden.bs.toast',function(){
        location.reload();
    });

    $('.section-devis .form').each(function(ind){
        $(this).find(':button').click(function(e){
            var form = $('.section-devis .form:eq(' + ind + ')').get(0),
                xhr = new XMLHttpRequest(), formData = new FormData(form),
                scroll = Math.floor($('.banner').offset().top);
			e = e || window.event();
			e.preventDefault();
            $('.section-devis .form .invalid-feedback').remove();
            $(form).find(':input').not(':button, :disabled, select').ctrlInput();
            if($(form).find('.invalid-feedback').get(0) === undefined){
                $(this).find('span').replaceWith('<span class="spinner-border spinner-border-sm ms-2"></span>')
                .prop('disabled', true);
                xhr.open('POST', 'server/server.php?do=update-page&item=' + ind);
                xhr.onreadystatechange = function(){
                    var resp, html, className = ind ? 'bi-send' : 'bi-arrow-right';
                    if(xhr.readyState == xhr.DONE && xhr.status == 200){
                        resp = JSON.parse(xhr.responseText);
                        if(resp.status){
                            pg = resp.item;
                            $('.summary .card-body').summary(resp.response);
                            if(pg == 0){
                                $('.section-devis .form').each(function(){
                                    this.reset();
                                });
                                toast.show();
                            }else{  
                                $('.section-devis .nav-link:eq(' + pg + ')').prop('disabled', false).trigger('click');
                                $(window).scrollTop(scroll);
                            }
                        }

                    }else if(xhr.readyState == xhr.DONE && xhr.status !== 200){
                        alert(xhr.status + ': ' + xhr.statusText);
                    }
                    $(form).find(':button').prop('disabled', false).find('span')
                    .replaceWith('<span class=""></span>');
                };
                xhr.send(formData);
            }
        });
    });

    $('.section-devis .form :input').each(function(){
        var type = $(this).attr('type');
        $(this).on({
            blur: function(){
                $(this).next('ins').remove();
                if(this.value)
                    $(this).ctrlInput();
                if($(this).next('ins').get(0) == undefined && $(this).val()){
                    if(type.indexOf('radio') == -1)
                        $(this).addClass('is-valid');
                }
            },
            focus: function(){
                $(this).removeClass('is-invalid').removeClass('is-valid');
                $(this).next('ins').remove();
            },
            change: function(){
                $('.section-devis .nav-link').each(function(ind){
                    if(ind > pg)
                        $(this).prop('disabled', true);
                });

                if(type == 'file'){
                    var xhr = new XMLHttpRequest(), rate,
                        formData = new FormData(), input = this;
                        formData.append('file', this.files[0]);

                    $(this).next('ins').remove();
                    $(this).ctrlInput();
                    if($(this).next('ins').get(0) === undefined){
                        xhr.open('POST', 'server/server.php?do=' + encodeURIComponent('upload-file'));
                        xhr.upload.onprogress = function(e){
                            rate = Math.round((e.loaded/e.total)*100);
                            $('.status-text').remove();
                            $(input).next('div').fadeIn(260, function(){
                                $(this).addClass('progress-bar-animated').children().css({width: rate + '%'}).text(rate + '%');
                            });
                        };
                        xhr.onload = function(){
                            var resp = JSON.parse(xhr.responseText);
                            if(resp.status == 200){
                                $(input).next('div').fadeOut(300, function(){
                                    $(this).removeClass('progress-bar-animated').children().css({width: '0%'}).text('0%');
                                    $(this).before('<p class="status-text valid-feedback d-block"><i class="ti-check-box"></i> Votre fichier a été transmis avec succès</p>');
                                });
                            }else{
                                $('.progress').after('<p class="status-text invalid-feedback d-block"><i class="ti-alert"></i> Erreur lors de la transmission du fichier</p>');
                            }
                        };
                        xhr.send(formData);
                    }
                }
            }
        });
    });
});