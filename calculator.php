<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Калькулятор</title>
	<meta name="description" content="Продажа типового комплекта документов по направлению деятельности вашей лаборатории! Тел: 8(800)301-60-09 E-mail: info@rosakklab.ru - аккредитация в национальной системе аккредитации лабораторий"/>
   

  </head>
  <style>
    .calc_div{
        width:100%;
        max-width:800px;
        border-radius:6px;
        box-shadow: 3px 0px 25px rgba(0, 0, 0, 0.25);
        margin:20px auto;
        padding:15px;
    }
    .calc_label{
        display:block;
    }
  </style>
  <body>  	
	<main id="app">
       
		<div class="container">
			<template v-for="item in data">
                <div class="calc_div">
                    <h4>{{item.title}}</h4>
                    <template v-for="(dot,index) in item.fields">
                        <label class="calc_label">
                            <input type="radio" :value="index" v-model="item.value">
                            <span>{{dot}}</span>
                        </label>
                    </template>
                </div>
            </template>
            <div class="calc_div">
                <h4 align="center">{{calculator}}</h4>
            </div>
		</div>
		
       
	</main>

  </body>
  <script src="vue.min.js"></script>
  <script>
    const app = new Vue({
    el: '#app',
    data(){
        return{
            data:[
                {title:"1.Система аккредитации:",value:"",fields:['Национальная система аккредитации (ФСА «Росаккредитация»)','Система аккредитации в области использования атомной энергии (ГК "Росатом")','Международная система аккредитации ILAC (АЦЦ «Аналитика»)']},
                {title:"2.Интересующий тип аккредитации:",value:"",fields:['Аккредитация Органа по сертификации','Аккредитация Лаборатории','Аккредитация Органа инспекции','Другой вид аккредитации']},
                {title:"3.Есть ли обученные специалисты с подтвержденным опытом более 3 лет",value:"",fields:['Нет','1-2','3-4','Больше 4','Нужно подобрать']},
                {title:"4.Планируемая численность специалистов проводящих испытания в соответствии с областью аккредитации",value:"",fields:['До 5','До 10','До 30','Свыше 30']},
                {title:"5.Количество документов, устанавливающих правила и методы исследований (испытаний), измерений",value:"",fields:['До 5','До 10','До 30','Свыше 30']},
                {title:"6.Количество мест осуществления деятельности (филиалов лаборатории)",value:"",fields:['1','2','3','Передвижная лаборатория']},
                {title:"7.Наличие оборудования (Оборудование должно охватывать всю область аккредитации.)",value:"",fields:['Да','Нет','Есть частично','Нужно подобрать']},
                {title:"8.Есть ли помещение (Минимум 5-7 кв.м. на одно оборудование, комната для приема образцов, для хранения расходных материалов, для обработки результатов испытаний)",value:"",fields:['Да','Нет','Нужно подобрать']},
                {title:"9.Выберите свой округ?",value:"",fields:['Центральный','Северо-Западный','Южный','Северо-Кавказский','Приволжский','Уральский','Сибирский','Дальневосточный']},
                {title:"10.Была ли ранее какая-либо аккредитация? (Возможно Вы были аккредитованы в добровольной системе)",value:"",fields:['Да','Нет']},
                {title:"11. Как срочно вы планируете приступить к аккредитации",value:"",fields:['В течение 2 недель','В течение месяца','В течение 3 месяцев','В течение 1 год другое']},
            ]
        }
    },
    computed:{
        calculator(){
            let error = false;
            this.data.forEach(function(elem,index){
                if(elem.value===""){
                    error = "Не указаны параметры в блоке "+(index+1);
                }
            })
            if(error){
                return error;
            }else{
                return "Стоимость аккредитации "+this.magik()+" 000 Рублей";
            }
        }
    },
    methods:{
        magik:function(){
            let obj = {
                k1:350,
                k2:0,
                k3:0,
                k4:0,
                k5:0,
                k6:0,
                k7:0,
                k8:0,
                k9:0,
                k10:0,
                k11:0
            }
            if(this.data[1].value===0||this.data[1].value===2){
                obj.k2 = 50;
            }
            switch (this.data[2].value) {
                case 0: obj.k3 = 10;break;     
                case 2: obj.k3 = -5;break;   
                case 3: obj.k3 = -10;break;   
                case 4: obj.k3 = 20;break; 
                default: obj.k3 = 0;break; 
            }
            //пункт 4
            switch (this.data[3].value) {
                case 1: obj.k4 = 15;break;     
                case 2: obj.k4 = 20;break;   
                case 3: obj.k4 = 30;break; 
                default: obj.k4 = 0;break; 
            }
            //пункт 5 
            switch (this.data[4].value) {
                case 1: obj.k5 = 10;break;     
                case 2: obj.k5 = 20;break;   
                case 3: obj.k5 = 30;break; 
                default: obj.k5 = 0;break; 
            }
            //пункт 6
            switch (this.data[5].value) {
                case 1: obj.k6 = 20;break;     
                case 2: obj.k6 = 30;break;   
                case 3: obj.k6 = 10;break; 
                default: obj.k6 = 0;break; 
            }
            //пункт 7
            switch (this.data[6].value) {
                case 1: obj.k7 = 10;break;  
                case 3: obj.k7 = 25;break; 
                default: obj.k7 = 0;break; 
            }
            //пункт 8
            switch (this.data[7].value) {
                case 1: obj.k8 = 10;break;     
                case 2: obj.k8 = 15;break;   
                default: obj.k8 = 0;break; 
            }
            //пункт 9
            switch (this.data[8].value) {
                case 2: obj.k9 = 5;break;     
                case 3: obj.k9 = 20;break;      
                case 4: obj.k9 = 5;break;      
                case 5: obj.k9 = 5;break;      
                case 6: obj.k9 = 15;break;      
                case 7: obj.k9 = 20;break;   
                default: obj.k9 = 0;break; 
            }
            //пункт 10
            if(this.data[9].value===0){
                obj.k10 = -5;
            }
            //пункт 11
            switch (this.data[10].value) {
                case 0: obj.k11 = -20;break;     
                case 1: obj.k11 = -10;break;     
                case 3: obj.k11 = 15;break;   
                default: obj.k11 = 0;break; 
            }
            let summ = 0;
            for(key in obj){
                summ +=obj[key];
            }
            return summ;

        }
    }
});

  </script>
</html>