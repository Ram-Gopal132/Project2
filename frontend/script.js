const emailContainer =document.querySelector('.email-container')
const otpContainer =document.querySelector('.otp-container')
const Submitotp=document.querySelector('.otp-submit')
const Submitemail=document.querySelector('.email-submit')
const emailError=document.querySelector('.email-error')
const otpError=document.querySelector('.otp-error')

Submitemail.addEventListener('click',(e)=>{
    e.preventDefault()
    if(document.querySelector('#email').value==''){
        error(emailError, "Email field can not be empty")
        return

    fetch('/backend/login.php',{
        method:'POST',
        body:new FormData(document.querySelector('.email-form'))

    })
    .then(res=>res.json())
    .then(data=>{
        if(data.status=='succes'){
            otpContainer.style.display='block'
            emailContainer,style.display='none'

        }
        else
        error(emailError, "you are not registered with us")
    })

    Submitotp.addEventListener('click',(e)=>{
        e.preventDefault()
        if(document.querySelector('#otp').value==''){
            error(otpError, "OTP field can not be empty")
            return

        }
        fetch('/backend/login.php',{
            method:'POST',
            body:new FormData(document.querySelector('.otp-form'))
    
        })
        .then(res=>res.json())
        .then(data=>{
            if(data.status=='succes'){
                window,location.replace("/project1/dashboard.html")
            }
            else
            error(otpError, "incorrect OTP provided")
        })

})

function error(span,msg){
    span.textContent = msg
    span.style.color='red'
    setTimeout(()=>{span.textContent},3000)
}