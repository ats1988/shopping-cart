//$(document).ready(function() {  
       // Add a jQuery validation procedure on the form
       
       
       $( "#add_product_form" ).validate({
           rules: {
                   name: {
                           required: true,
                           minlength: 4,
                           maxlength: 20,
                           pname_cust_vld: true
                   },
                   price: {
                           required: true,
                           number:true,
                           min:1.0,
                           max:1000.0,                         
                   },
                   qnt: {
                           qty_cust_vld:true
                   },                  
                   code: {
                           required: true,
                           code_cust_vld: true
                   }
               },
                   
           messages: {
                   name: {
                           required: "יש להקליד שם מוצר",
                           minlength: $.format("יש להקליד לפחות " + "{0}" + " תווי אותיות"),
                           maxlength: $.format("לא יותר מ-"+"{0} "+"תווים, בבקשה"),
                           pname_cust_vld: "יש להקליד אך ורק אותיות"
                   },
                   price: {
                           required: "יש להקליד  מחיר מוצר",
                           number: "יש להקליד ערך מספרי",
                           min:"מחיר המוצר בין 1 ל-1000",
                           max:"מחיר המוצר בין 1 ל-1000",
                   },
                   qnt: {
                           qty_cust_vld: "יש להכניס מספר שלם בין 0 ל-1000"
                   },                
                   code: {
                           required: "יש להקליד קוד מוצר",
                           code_cust_vld: "הקוד צריך להתחיל באות " + "A-C" + " ולאחריה 3 ספרות"
                   }
                   
           }
       });
   
   // Add custom validation functionality
   $.validator.addMethod("pname_cust_vld",
           function(value, element) {
                   return /^[A-Za-z\u0590-\u05FF ]+$/.test(value);
           }
   );   
   $.validator.addMethod("qty_cust_vld",
           function(value, element) {
                   var val = value.trim();
                   if (val == "") return true; // as this field is optional
                   if (!$.isNumeric(val) || (Math.floor(val) != val))
                       return false;
                   if (val < 0 || val > 1000) 
                       return false;
                   return true;
           }
   );       
   $.validator.addMethod("code_cust_vld",
           function(value, element) {
                   return /^[A-C]\d{3}$/.test(value);
           }
   );

   // If all other checks are OK, catch form submit and do some
   // cross fields validation
   $("#add_product_form").submit( function()
   {
      // get the quantity value. If blank, no need to check
     var q = $("#qnt").val().trim();
     if (q == "") return true;
     // check quantity in case of בקבוקים וארגזים
     if ($("#r2")[0].checked && q > 500)
     {
        $("#info").text("כמות התחלתית לאריזה בארגזים לא תעלה על 500").show();
        return false;
     }
     else if ($("#r3")[0].checked && q > 800)
     {
        $("#info").text("כמות התחלתית לאריזה בבקבוקים לא תעלה על 800").show();      
        return false;
     }
     return true;
   })
//});
