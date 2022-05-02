(function($) {

    let formValidation = {
        fieldsStatus: {
            amount : false,
            buyer : false,
            receipt_id: false,
            buyer_email : false,
            items: false,
            phone: false,
            note : false,
            city : false,
            entry_by : false,
        },

        submitStatus: false,

        init: function(){
            this.itemFieldInit();
            this.initFormValidate();
            this.customValidate();
            this.buttonState();
        },

        initFormValidate: function(){
            $('#register-form').validate({
                ignore: [],
                rules : {
                    amount : {
                        required: true
                    },
                    buyer : {
                        required: true,
                        inputLimitation: true,
                        maxlength: 20
                    },
                    receipt_id : {
                        required: true,
                        receiptIdValidate: true
                    },
                    buyer_email : {
                        required: true,
                        emailValidate : true
                    },
                    items : {
                        required: true
                    },
                    phone : {
                        required: true,
                        phoneValid: true
                    },
                    note : {
                        required: true,
                        validateNote: true
                    },
                    city : {
                        required: true,
                        cityValidate: true
                    },
                    entry_by : {
                        required: true,
                    }
                },
                onkeyup: this.validateAction.bind(this)
            });
        },

        validateAction: function (element){
            if($(element).attr('id') === 'items-selectized') {
                let item = $('#items');
                let itemsVal = /^[a-zA-Z,?\s]+$/.test(item.val());

                if($(".selectize-input.items").hasClass("has-items") === false || itemsVal === false){
                    let massage = itemsVal === false && item.val() === '' ? 'Please input items and press enter to add.' : 'Only allow text';
                    if(item.parent().find(".error").length === 0){
                     item.parent().append('<label id="receipt_id-error" class="error" for="items">'+massage+'</label>');
                    }
                }else{
                    item.parent().find(".error").remove();
                }

                if(itemsVal){
                    this.fieldsStatus['items'] = true;
                }else{
                    this.fieldsStatus['items'] = false;
                }
            }else if($(element).attr('id') === 'note'){
                let notes = $(element).val();
                if(/&#x[0-9A-Fa-f]{4}/.test(notes)){
                    let matchCode = notes.match(/&#x[0-9A-Fa-f]{4}/g);
                    matchCode.forEach(function(item, index){
                        let unNubmer = item.replace("&#x", "");
                        let unIcon = String.fromCodePoint(parseInt(unNubmer, 16));
                        $(element).val( notes.replace( item, unIcon ) );
                    });
                }
                this.fieldsStatus[$(element).attr('id')] = $(element).valid();
            }else if($(element).attr('id') === 'phone'){
                let phoneNumber = $(element).val();
                if(/\b880/.test(phoneNumber) === false){
                    $(element).val("880" + phoneNumber.replace('0',''));
                }
                this.fieldsStatus[$(element).attr('id')] = $(element).valid();
            }else{
                this.fieldsStatus[$(element).attr('id')] = $(element).valid();
            }

            this.buttonState();
        },

        customValidate: function() {
            $.validator.addMethod('inputLimitation', (value, element) => {
                return /^[a-zA-Z0-9\s]*$/.test(value);
            },"Only allow latter space and number");

            $.validator.addMethod('emailValidate', (value, element) => {
                return /\S+@\S+\.\S+/.test(value);
            },"Please enter a valid email address");

            $.validator.addMethod('phoneValid', (value, element) => {
                return /(^880)([0-9]{10})/.test(value);
            },"Please enter a valid number");

            $.validator.addMethod('cityValidate', (value, element) => {
                return /^[a-zA-Z\s]*$/.test(value);
            },"Only allow latter and space");

            $.validator.addMethod('receiptIdValidate', (value, element) => {
                return /^[a-zA-Z\s]*$/.test(value);
            },"Only allow latter");

            $.validator.addMethod('validateNote', (value, element) => {
                return (value.split(" ").length - 1) <= 29;
            },"Only allow 30 words");
        },

        itemFieldInit: function(){
            $('#items').selectize({
                persist: false,
                create: true
            });
        },

        buttonState: function(){
            for (const [key, value] of Object.entries(this.fieldsStatus)) {
               if( value === false){
                 this.submitStatus = false;
                 break;
               }else{
                 this.submitStatus = true;
               }
            }

            if(this.submitStatus){
                $('#submit').prop('disabled', false).css("cursor", "pointer").fadeTo(200,1);
            }else{
                $('#submit').prop('disabled', true).css("cursor", "not-allowed").fadeTo(200,0.2);
            }
        }
    }

    formValidation.init();

})(jQuery);