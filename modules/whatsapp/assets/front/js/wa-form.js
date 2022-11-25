(function() {
    let WAFormReady = false;

	// text template dari option
	let WATextTemplate = null;

	// breakdancePopupInstance
	let WAPopUp;

    //Breakdance Form that use Send WA Action
    let WAForm;

    //available WA fields in Form
    let WAFields;

    if (document.readyState !== 'loading') {
        onContentLoaded();
    } else {
        document.addEventListener('DOMContentLoaded', function () {            
            onContentLoaded();
        });
    }
    
    function onContentLoaded() {
        if (_vxn_data_vxn_wa_form.form.show) {
            for (const link of document.querySelectorAll('a')) {		
                if(link.href.includes(_vxn_data_vxn_wa_form.url)){
                    link.onclick = clickWhatsAppLink;
                }	
            }
            
            if(typeof breakdancePopupInstances === 'undefined') {	
                console.warn('breakdancePopupInstances is not defined!');	
                return;
            }
            
            WAPopUp = breakdancePopupInstances[_vxn_data_vxn_wa_form.form.post_id];
            if( typeof WAPopUp === 'undefined' ) {
                console.warn('WAPopUp is not defined!');
                return;
            }

            WAForm = WAPopUp.element.querySelector('#' + _vxn_data_vxn_wa_form.form.wa_text_id).parentElement.parentElement;
            if( WAForm === null || WAForm.tagName != 'FORM' ) {
                console.warn('WAForm is not found!');
                return;
            }

            WAForm.onsubmit = onFormSubmit;
            
            WAFields = getWAFormFields(WAForm);
            addWAFieldsOninputEvent();
            
            WAFormReady =  true;
        }
    }

    function addWAFieldsOninputEvent() {
        if(WAFields.text !== null) { 
            if (WAFields.name !== null) {
                WAFields.name.oninput = updateWaTextValue;
            }
            
            if (WAFields.phone !== null) {
                WAFields.phone.oninput = updateWaTextValue;	
            }

            if (WAFields.email !== null) {
                WAFields.email.oninput = updateWaTextValue;	
            }            
        }
    }

	function getWAFormFields(el) {
		return {
			name: el.querySelector('#' + _vxn_data_vxn_wa_form.form.wa_name_id),
			phone: el.querySelector('#' + _vxn_data_vxn_wa_form.form.wa_phone_id),
			text: el.querySelector('#' + _vxn_data_vxn_wa_form.form.wa_text_id),
			email: el.querySelector('#' + _vxn_data_vxn_wa_form.form.wa_email_id)
		}
	}

	function onFormSubmit() {
		// buang element message karena tidak diperlukan (bikin bingung)
		let el_message = document.getElementsByClassName('breakdance-form-message');
		for (var i = 0; i < el_message.length; i++) {
			el_message[i].remove();
		}

        openWhatsApp(WAFields.text.value);
        WAPopUp.close();        
	}

	function openWhatsApp(text) {
		window.open(_vxn_data_vxn_wa_form.url + '&text=' + encodeURI(text), '_self');
	}

	// fungsi untuk mengubah text template sesuai dengan nama dan notelp yg diinput
	function updateWaTextValue() {	
		let text_value = WATextTemplate;

		if ( (WAFields.name.value !== '') && (text_value.indexOf('{name}') !== -1) ) {		
			text_value = text_value.replace('{name}', WAFields.name.value);
		}
		
		if ( (WAFields.phone.value !== '')  && (text_value.indexOf('{phone}') !== -1) ) {
			text_value = text_value.replace('{phone}', WAFields.phone.value);
		}

        if ( (WAFields.phone.value !== '')  && (text_value.indexOf('{email}') !== -1) ) {
			text_value = text_value.replace('{email}', WAFields.phone.value);
		}
		
		WAFields.text.value = text_value;
	}

	function clickWhatsAppLink(event){
		event.preventDefault();
		
		let queryString = event.currentTarget.href.split('?')[1];
		const wa_params = new URLSearchParams(queryString);

		WATextTemplate = _vxn_data_vxn_wa_form.text_default;

		if(wa_params.has('text')){
			WATextTemplate =  wa_params.get('text');
		}	
		
		if(WAFormReady) {
			updateWaTextValue();
			WAPopUp.open();
		} else {
			openWhatsApp(WATextTemplate);
		}			
	}
	
})();