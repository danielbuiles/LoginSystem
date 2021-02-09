const Form = document.getElementById('Form');
const inputs =document.querySelectorAll('#Form input');

const expresiones = {
    usuario: /^[a-zA-Z0-9\_\-]{4,16}$/,
    password: /^.{4,12}$/
}

const Campos= {
    usuario: false,
    password:false
}

const ValidarDates = (e) =>{
    switch (e.target.name) {
        case "usuario":
                if (expresiones.usuario.test(e.target.value)) {
                    document.getElementById('Text-Error').classList.remove('Text-Error-activo');
                    document.getElementById('icon').classList.remove('Formulario_icono--estado-activo');
                    Campos.usuario=true;
                }
                else{
                    document.getElementById('Text-Error').classList.add('Text-Error-activo');
                    document.getElementById('icon').classList.add('Formulario_icono--estado-activo');
                    Campos.usuario=false;
                }
            break;
        case "password":
            if (expresiones.password.test(e.target.value)) {
                document.getElementById('Text-Erro').classList.remove('Text-Error-activo');
                document.getElementById('ico').classList.remove('Formulario_icono--estado-activo');
                Campos.password=true;
            }
            else{
                document.getElementById('Text-Erro').classList.add('Text-Error-activo');
                document.getElementById('ico').classList.add('Formulario_icono--estado-activo');
                Campos.password=false;
            }
            break;
    }
}

inputs.forEach((input) => {
    console.log('Hola soy elfo!',input);
    input.addEventListener('keyup', ValidarDates);
    input.addEventListener('blur', ValidarDates);
});

Form.addEventListener('submit', (e) =>{
    if (Campos.usuario && Campos.password ) {
        
    }
    else{
        e.preventDefault();
    }
});
setTimeout(()=>{
    document.getElementById('usuario_no--resgitrado').classList.add('form_p--error--desactivado');
    document.getElementById('password_incorrecta').classList.add('form_p--error--desactivado');
},3000);