$(function(){
    var ctrl = false, path = new String(window.location);
    $(window).load(function(){
        $.ajax({
            url: './server/server.php?do=load-page',
            dataType: 'json',
            data: {
                path: path
            },
            success: function(data){
                var resp = data.cookies;
                for(var id in resp){
                    $('.form-contact :input').each(function(){
                        if($(this).attr('name') === id)
                            $(this).val(resp[id]);
                    });
                }
            }
        });
    });

    $('.section-contact form :input:lt(5)').each(function(ind){
        $(this).on({
            'blur': function(){
				$(this).parent().find('ins').remove();
                if($(this).val()){
                    $(this).ctrlInput();
                    if(typeof $(this).parent().find('ins').get(0) === 'undefined')
                        $(this).addClass('is-valid');
                }
            },
            'focus': function(){
                $(this).removeClass('is-invalid').removeClass('is-valid').
                parent().find('ins').hide('slide', 'fast', function(){
                    $(this).remove();
                });
            }
        });        
    });
	
    $('.section-contact form :submit').click(function(e){
        var form = $('.section-contact form').get(0), formData = new FormData(form),
            xhr = new XMLHttpRequest(), btn = this;
        e = e || window.event;
        e.preventDefault();
		$('.invalid-feedback').remove();
		$('.form-contact :input').not(':button, :checkbox').ctrlInput();
		if(typeof $('.section-contact form').find('.invalid-feedback').get(0) === 'undefined'){
            $(this).find('span').replaceWith('<span class="spinner-border spinner-border-sm ms-2"></span>')
            .prop('disabled', true);
            xhr.open('POST', './server/server.php?do=contact');
            xhr.onreadystatechange = function(){
                var str;
                if(xhr.readyState == xhr.DONE && xhr.status == 200){
                    var toast = new bootstrap.Toast($('.toast').get(0), {delay: 10000});
                    toast.show();
                    $('.form-contact :input').not(':submit, :checkbox').each(function(){
                        if($(this).hasClass('is-valid'))
                            $(this).removeClass('is-valid');
                    });
                    $(btn).prop('disabled', false).find('.spinner-border').replaceWith('<span class="bi-send"></span>');
                    $('.section-contact form').get(0).reset();
                }else if(xhr.readyState == xhr.DONE && xhr.status != 200)
                    alert(xhr.status + ': ' + xhr.statusText);
            };
            xhr.send(formData);
        }
    });
    function initMap(){
        var latlng = new google.maps.LatLng(4.08573191901881, 9.734179112017367),
        options = {
            center: latlng,
            zoom: 5,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        },
        marqueur = new google.maps.Marker({
            position: new google.maps.LatLng(4.08573191901881, 9.734179112017367),
            map: carte
        }),
        carte = new google.maps.Map($('.map').get(0), options);
    }
    initMap();
    
});