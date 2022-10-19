(function() {
	// text template dari option
	let WATextTemplate = null;

	// breakdancePopupInstance
	let WAPopUp;

	// hasil clone WA Form Fields
	let clonedWAField = null;

	function getWaPopup() {

		if(typeof breakdancePopupInstances === 'undefined') {	
			console.warn('breakdancePopupInstances is not defined!');	
			return undefined;
		}

		let bdPopUp = null;
		let elWrapper = null;

		elWrapper = document.getElementsByClassName('breakdance-popup')[_vxn_wa_form_data.wrapper_id];
		if( typeof elWrapper === 'undefined' ) {
			console.warn('WA PopUp is not defined!');	
			return undefined;
		}

		bdPopUp = breakdancePopupInstances[elWrapper.getAttribute('data-breakdance-popup-id')];

		if( typeof bdPopUp === 'undefined' ) {
			console.warn('Breakdance PopUp for WA is not defined!');	
			return undefined;
		}

		// --
		const WAForm = {
			field: getWAFormFields(elWrapper),
			button: elWrapper.querySelector('#' + _vxn_wa_form_data.form.btn_submit_id),
			fieldClone: function () {
				cloned = elWrapper.cloneNode(true);
				return getWAFormFields(cloned);
			}
		}
		
		if(WAForm.field.text !== null) {
			// add event onInput pada field nama
			if (WAForm.field.name !== null) {
				WAForm.field.name.oninput = updateWaTextValue;
			}
			
			// add event onInput pada field phone
			if (WAForm.field.phone !== null) {
				WAForm.field.phone.oninput = updateWaTextValue;	
			}
		}
		
		//buat event onclick pada button, ini diexecute sebelum submit data
		if(WAForm.button !== null) {
			WAForm.button.onclick = cloneForm;		
		}

		bdPopUp.form = WAForm;
		
		return bdPopUp;

	}

	function getWAFormFields(el) {
		return {
			name: el.querySelector('#' + _vxn_wa_form_data.form.wa_name_id),
			phone: el.querySelector('#' + _vxn_wa_form_data.form.wa_phone_id),
			text: el.querySelector('#' + _vxn_wa_form_data.form.wa_text_id),
			email: el.querySelector('#' + _vxn_wa_form_data.form.wa_email_id)
		}
	}

	function cloneForm() {
		if (typeof WAPopUp !== 'undefined') {
			clonedWAField = WAPopUp.form.fieldClone();
		}
	}

	// Panggil di JS on succes popup
	function onFormSuccess() {
		// buang element message karena tidak diperlukan (bikin bingung)
		let el_message = document.getElementsByClassName('breakdance-form-message');
		for (var i = 0; i < el_message.length; i++) {
			el_message[i].remove();
		}

		if (clonedWAField !== null) {
			openWhatsApp(clonedWAField.text.value);
		}
	}

	function openWhatsApp(text) {
		window.open(_vxn_wa_form_data.url + '&text=' + encodeURI(text), '_self');
	}

	// fungsi untuk mengubah text template sesuai dengan nama dan notelp yg diinput
	function updateWaTextValue() {	
		let text_value = WATextTemplate;

		if ( (WAPopUp.form.field.name.value !== '') && (text_value.indexOf('{name}') !== -1) ) {		
			text_value = text_value.replace('{name}', WAPopUp.form.field.name.value);
		}
		
		if ( (WAPopUp.form.field.phone.value !== '')  && (text_value.indexOf('{phone}') !== -1) ) {
			text_value = text_value.replace('{phone}', WAPopUp.form.field.phone.value);
		}
		
		WAPopUp.form.field.text.value = text_value;
	}


	function clickWhatsAppLink(event){
		event.preventDefault();
		
		let queryString = event.currentTarget.href.split('?')[1];
		const wa_params = new URLSearchParams(queryString);

		WATextTemplate = _vxn_wa_form_data.text_default;

		if(wa_params.has('text')){
			WATextTemplate =  wa_params.get('text');
		}	
		
		// return;
		if(typeof WAPopUp !== 'undefined') {
			updateWaTextValue();
			WAPopUp.open();
		} else {
			openWhatsApp(WATextTemplate);
		}			
	}

	if (_vxn_wa_form_data.form.show) {
		window.addEventListener('DOMContentLoaded', function(){	
			for (const link of document.querySelectorAll('a')) {		
				if(link.href.includes(_vxn_wa_form_data.url)){
					link.onclick = clickWhatsAppLink;
				}	
			}			
			WAPopUp = getWaPopup();	
		});
		window.vxn_onFormSuccess = onFormSuccess;
	}
	
})();