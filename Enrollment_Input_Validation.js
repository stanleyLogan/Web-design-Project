var SubmitButton=document.getElementById('Submit-Button');
        // Regex Evaluation For Each Field
        var Regex_First_Name=/^[A-Z][a-z]{1,10}$/ //Start with one uppercase then between 1-10 lowercase
        var Regex_Last_Name=/^[A-Z][a-z]{1,10}$/  //Start with one uppercase then between 1-10 lowercase
        var Regex_Student_Major=/^[A-Z][a-z]{1,15}\s?\-?[A-Z]?[a-z]{0,15}$/ //Start with uppercase then 1-15 lowercase (optional space) + (optional "-") then another uppercase (optional) and 0-15 additional lowercase letters
        var Regex_Student_Email=/^[0-9A-Za-z"'-]{0,25}@[A-Za-z\.0-9]+\.(com|org|gov|co|edu|net)$/ //A regex that basically formatts an email address without writing a paragrpah to explain it
        
    SubmitButton.addEventListener("click",async function(event){                                                         //This event triggers when the button is clicked & is an asyc function type
        event.preventDefault();                                                                                         // prevent default submission
        var MyForm = document.getElementById('MyFormData');                                                             // Returns the object representing the form and its data
    
        const PromisesArray = Array.from(MyForm.elements).map(FormField =>{
            return new Promise(resolve =>{
                FormField.ValidationData= true;                                                                         //Appends a true/false ValidationData to the object. 
                
                                                                                                  // Creates an promises array and "resolves" each promise through evaluating the Regex statement using .test(FormField)
                /*console.log(FormField)*///Testing Purposes                                     //Also this uses the Map()Function because I think its better at "transforming" the array by updating the appended ValidationData Attribute if needed
                if (FormField.name==="FirstName"){
                
                    if(Regex_First_Name.test(FormField.value) && FormField.value !== ''){
                        /*console.log(`${FormField.value}+'Passed The Test'`);*/
                    }else{
                        FormField.ValidationData=false
                    }
                }
                if (FormField.name==="LastName"){
                
                    if(Regex_Last_Name.test(FormField.value) && FormField.value !== ''){
                        /*console.log(`${FormField.value}+'Passed The Test'`);*/
                    }else{
                        FormField.ValidationData=false
                    }
                }
                if (FormField.name==="StudentMajor"){
                
                    if(Regex_Student_Major.test(FormField.value) && FormField.value !== ''){
                        /*console.log(`${FormField.value}+'Passed The Test'`);*/
                    }else{
                        FormField.ValidationData=false
                    }
                }
                if (FormField.name==="StudentEmail"){
                
                    if(Regex_Student_Email.test(FormField.value) && FormField.value !== ''){
                        /*console.log(`${FormField.value}+'Passed The Test'`);*/
                    }else{
                        FormField.ValidationData=false
                    }
                 }
                resolve();                                                                               // Once all the array elements have been processed then we resolve them. 
        });
    });

    await Promise.all(PromisesArray)                                                                    // Calls the function but only after previous code execution because it dosent make sense to do error boxes before we know if the fields are wrong
        .then(() => {
            AlertBoxConstructor(MyForm.elements); //Runs the function but only after the previous promise is fulfilled.
        });
});

async function AlertBoxConstructor(FormData) {
    const Error_Fields= []; 
    const Correct_Fields=[];                                                                            // I created an array to store the fields that have errors so I can join them later into an alert message
    Array.from(FormData).forEach(FormField => {                                                         //I created another array to store the correctly inputted fields
        if (FormField.ValidationData===false){
            Error_Fields.push(FormField.name)                                                           
        }
    });
    if(Error_Fields.length>0){                                                          // Puts the name of the from field that has an issue into the front of the array
                alert(`The following inputs are incorrect: ${Error_Fields.join(", ")}                   
        
        Here are formatting rules:
        1. All names must start with a capital letter (EX: John Smith).
        2. Student Majors must be capitalized (EX: Enviromental Science).
        3. Emails must follow conventional email format (EX: JohnSmith@yahoo.com).`)
    }else{
        Array.from(FormData).forEach(FormField => {
            if (FormField.name==="FirstName" && FormField.value !== ''){
                Correct_Fields.push(FormField.value);
            }

            if (FormField.name==="LastName" && FormField.value !== ''){
                Correct_Fields.push(FormField.value);
            }

            if (FormField.name==="StudentMajor" && FormField.value !== ''){
                Correct_Fields.push(FormField.value);
            }

            if (FormField.name==="StudentEmail" && FormField.value !== ''){
                Correct_Fields.push(FormField.value);
            }
            if (FormField.name==="StudentYear" && FormField.value !==''){
                Correct_Fields.push(FormField.value)//Automatically added because it can't be incorrect
            }
        });
        alert(`The form was submitted correctly. The following information was submitted:\n
            ${Correct_Fields.join(",")}`);
    }
};
     
