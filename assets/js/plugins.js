(function($){

	$.fn.loadImg = function(link){
		var img = new Image();
		this.each(function(){
			var elt = this;
			img.onload = function(){
				$(elt).empty();
				$(elt).append(img);
			};
			img.src = link;
		});
		return this;
	};

	$.fn.ctrlInput = function(){
		var message, timestamp_deb;
		this.each(function(){
			var nameAttr = $(this).attr('name');
			message = null;
			if($(this).val()){
				switch(nameAttr){
					case 'nom': 
						if(/^\W+/.test($(this).val()) || $(this).val().length < 2)
							message = 'Oops!! Votre nom est incorrect.';
						break;
					case 'tel':
						if(!/^6[25-9]([0-9]){7}$/.test($(this).val()))
							message = 'Oops!! numéro de téléphone invalide';
						break;
					case 'email':
						if(!/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/.test($(this).val()))
							message = 'Oops!! adresse e-mail invalide.';
						break;
					case 'password': 
						if($(this).val().length < 8 || /\s+/.test($(this).val()))
							message = 'Oops!! Le mot de passe doit contenir au moins 8 caractères.';
						break;
					case 'url':
						if(!/^((https?|ftp):\/\/)?(w{3}\.)?[a-z0-9._-]+\.[a-z]{2,3}/i.test($(this).val()))
							message = 'Oops!! L\'URL est invalide';
						break;
					case 'graduate':
						alert(this.value);
						break;
					case 'details': 
						if($(this).val().length < 15)
							message = 'Oops!! Ce champ doit contenir au moins 15 caractères.';
						break;
					case 'test':
						if($(this).val() != 111)
							message = 'Oops!! échec du test';
						break;
                    case 'date_debut':
                    	var tabDate = this.value.split('-'),
                    		timestamp_deb = new Date(tabDate[0], --tabDate[1], tabDate[2]).getTime();

            			if(timestamp_deb < new Date().getTime())
                    		message = 'Oops!!Date incohérente';
                    	break;
                    case 'date_fin':
                    	var tabDateFin = this.value.split('-'),
                    		tabDateDeb = $(this).parent().prev('div').find(':input').get(0).value.split('-'),
                    		timestamp_deb = new Date(tabDateDeb[0], --tabDateDeb[1], tabDateDeb[2]).getTime(),
                    		timestamp_fin = new Date(tabDateFin[0], --tabDateFin[1], tabDateFin[2]).getTime();
               
                    		if(timestamp_fin < timestamp_deb)
                    			message = 'Oops!! Date incohérente.';
                    	break;    	 
					case 'budget':
						if(isNaN($(this).val()))
							message = 'Oops!! Cette valeur est incorrecte.';
						break;
					case 'file':
						var f_name = this.files[0].name;
						if(!/jpe?g|png|pdf/.test(f_name.substring(f_name.lastIndexOf('.')).toLowerCase()))
							message = 'Oops!! Format non pris en compte.';
						else if(this.files[0].size > 2000000)
							message = 'Oops!! La taille du fichier ne doit pas excéder 2Mo';
				}
			}else if(this.required)
				message = 'Oops!! ce champ est obligatoire.';
			if(message != null)
				$(this).addClass('is-invalid').after('<ins class="invalid-feedback"><i class="bi-exclamation-triangle-fill"></i> ' + message + '</ins>');
			else
				$(this).removeClass('is-invalid');
			return this;
		});
	};

	$.fn.summary = function(data){
		var html;
		this.each(function(){
			html = $.map(data, function(elt){
				var h = '';
				for(var id in elt){
                    switch(id){
                        case 'nom':
                            h += '<li class="nav-item"><span class="bi-person-circle"></span> ' + elt[id] + '</li>';
                            break;
                        case 'prenom':
                            h = h.substring(0, h.lastIndexOf('<'));
                            h += ' ' + elt[id] + '</li>';
                            break;
                        case 'email':
                        	h += '<li class="nav-item"><span class="bi-envelope"></span> ' + elt[id] + '</li>';
                        	break;
                        case 'tel':
                            h += '<li class="nav-item"><span class="bi-telephone"></span> ' + elt[id] + '</li>';
                            break;
                        case 'activity':
                            h += '<li class="nav-item"><span class="bi-briefcase"></span> ' + elt[id] +'</li>';
                    }
                }
				return h;
			}).join('');
			$(html).wrapAll('<ul class="nav flex-column"></ul>');
			$(this).html(html);
		});
		return this;
	};

	$.fn.showNbreVisit = function(nbreVisit){
		this.each(function(){
			document.querySelector('.counter-visit').innerHTML = nbreVisit;
			/*
			var n = $(this).text(),
			timer =  setInterval(function(){
				if(n < nbreVisit){
					n++;
					document.querySelector('.counter-visit').innerHTML = n;
				}else
					clearInterval(timer);
			}, 50);
			*/
		});
		return this;			 
	};

})(jQuery);