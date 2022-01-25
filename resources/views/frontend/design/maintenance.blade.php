

@include('frontend.design.header')
<body>
 

     <div 
     style="
     text-align: center;
     font-weight:bold;
     color:red;
     margin-top:50px;
     font-family: 'Cairo', sans-serif">
       {!! setting()->message_maintenance !!} 
       </div>  



<div class="rep" style="position: relative;hight:50px">
    <img  
    style="position: absolute;
    margin-left: auto;
    margin-right: auto;
    left: 0;
    right: 0;
    top:100px;
    max-width:100%" 
    src="{{ asset('frontend/images/main.png') }}" 
    alt="maintenance">
    
  
</div>


</body>
</html>