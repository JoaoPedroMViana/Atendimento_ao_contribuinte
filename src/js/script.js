let input = document.getElementById("pass");
let input2 = document.getElementById("pass2");
let checkbox = document.getElementById("mostrar-senha");
let checkbox2 = document.getElementById("mostrar-senha2");

function MostrarSenha(input, checkbox) {
    checkbox.addEventListener("change", () => {
        if(checkbox.checked){
            input.type = "text";
        }else{
            input.type = "password";
        }
    });
}

MostrarSenha(input, checkbox);
MostrarSenha(input2, checkbox2);