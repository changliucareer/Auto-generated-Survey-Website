<!DOCTYPE html>
<html>
<head>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<link href="myform.css" rel="stylesheet">
<script type="text/javascript" src="surveys_new.js"></script>
<script src="timeme.min.js"></script>
</head>

<body>

<h1></h1>

<div>
  <form  id="myform" name="myform" @submit="processForm" action="http://localhost/~liuc" method="post">
  <h1>Near-synonyms Distinguishing Task</h1>
  
  <section id='instruction' name='instruction'>
  <p>
  <span style="font-weight:bold">Instructions</span>: We are conducting an academic study about English near-synonyms (the words having the similar meaning but with some differences). We want to study adults in the United States who can read and understand English well and to learn how well they can make decisions about  near-synonyms. Please complete the entire questionnaire. All fill-in-the-blanck questions  are multiple choice with only one correct answer. If you would like to do so, you are allowed to look up the meaning of each word if you don&#39t know it. But please don&#39t search for the question sentence itself. Please give your  answer for  the  best word you think should be used to fill in the blank even if you are not sure about the answer. When there is more than one blank in the sentence, please only answer about  the blank with a &#34?&#34 in  it.
  </p>
  <p>Required fields are followed by <strong><abbr title="required">*</abbr></strong>.</p>
  </section>

  <section id='discussion'>
  <span style="font-weight:bold"> Differences among synonyms: </span>
  </section>

  <section id='section1' name='section1'>
    <h2>Contact information</h2>
    <p>
      <label for="turkerId">
        <span>TurkerId: </span>
        <strong><abbr title="required">*</abbr></strong>
      </label>
      <input type="text" id="turkerId" name="turkerId" v-model="turkerId">
      <span v-if="requiredShow.length>1" style="color:red"> {{requiredShow[0]}} </span>
    </p>
    <p>
      <label for="userEmail">
        <span>E-mail: </span>
        <strong><abbr title="required">*</abbr></strong>
      </label>
      <input type="email" id="userEmail" name="userEmail" v-model="userEmail">
      <span v-if="requiredShow.length>2" style="color:red"> {{requiredShow[1]}} </span>
    </p>
    <p>
      <lable for="levelField">
        <span>English Proficiency Levels: </span>
        <strong><abbr title="required">*</abbr></strong>
      </lable>
      <span v-if="requiredShow.length>3" style="color:red"> {{requiredShow[2]}} </span>
      <fieldset id="levelField" name='levelField'>
        <ul>
            <li>
              <label for="level_1">
                <input type="radio" id="level_1" name="level" v-model="level" value="N">
                Native / Bilingual Proficiency
              </label>
            </li>
            <li>
              <label for="level_2">
                <input type="radio" id="level_2" name="level" v-model="level" value="P">
                Professional Working Proficiency
              </label>
            </li>
            <li>
              <label for="level_3">
                <input type="radio" id="level_3" name="level" v-model="level" value="L">
                Limited Working Proficiency 
              </label>
            </li>
        </ul>
      </fieldset> 
    </p>
  </section>

  <section id='section2'>
    <h2  id='section2header'>Fill in the blank tasks (all required)</h2>
    <div>
      <fieldset v-for="(x,qindex) in qlist">
        <legend v-bind:id="'q'+qindex">{{ x.question }} 
        <span v-if="requiredShow.length>3+qindex" style="color:red"> {{requiredShow[3+qindex]}} </span>
        </legend>
        
        <ul>
          <li v-for="o in x.options">
            <label for="option">
              <input type="radio" id="option" v-bind:name="'question'+qindex" v-bind:value="o">
              {{o}}
            </label>
          </li>
        </ul>
      </fieldset>
      
    </div>
  </section>

  <button type="submit">Submit answers</button>

  <!--
  <div class = "error-message">
  <p v-if="errors.length >= 1" >
    <b>Please correct the following error(s):</b>
    <ul>
      <li v-for="error in errors">{{ error }}</li>
    </ul>
  </p>
  </div>
  -->

  </form>

</div>

<script>
  
  function getRandomIntInclusive(min, max) {
  min = Math.ceil(min);
  max = Math.floor(max);
  return Math.floor(Math.random() * (max - min + 1) + min); //The maximum is inclusive and the minimum is inclusive
  }

  var randomSurveyId = getRandomIntInclusive(0,890);
  var mysurvey= surveys[randomSurveyId];
  var mylist = mysurvey['questionList'];

  var tag = document.createElement("span");
  var text = document.createTextNode(mysurvey['wordSetString']);
  tag.appendChild(text);
  var element = document.getElementById("discussion");
  element.appendChild(tag);
  
  var tag = document.createElement("p");
  var text = document.createTextNode(mysurvey['original_discussion']);
  tag.appendChild(text);
  var element = document.getElementById("discussion");
  element.appendChild(tag);
  
  Vue.config.devtools = true;

  myObject = new Vue({
    el: '#myform',
    data: {
      qlist: mylist,
      turkerId: null,
      userEmail:null,
      level:null,
      errors: [],
      answers: [],
      requiredShow:[],
    },
    methods:{
      processForm: function(e){
        this.formtop = document.getElementById("myform").getBoundingClientRect()
        this.errors=[];
        this.requiredShow=[];
        for (let r=0; r<this.qlist.length+3; r++){
          this.requiredShow.push("");
        };

        if (!this.turkerId){
          this.errors.push("Turker Id required"); 
          this.requiredShow[0]="(required)";
          e.preventDefault();
        }; 
        if (!this.userEmail){
          this.errors.push("Email required");
          this.requiredShow[1]="(required)";
          if (typeof this.userEmail === 'email'){
            this.errors.push("invalid Email");
          }
          e.preventDefault();
        };
        if (!this.level){
          this.errors.push("English level required");
          this.requiredShow[2]="(required)";
          e.preventDefault();
        };

        for (let i=0; i<this.qlist.length; i++){
          var curQname = 'question'+i;
          var curChecked = false;
          var curQ = document.getElementsByName(curQname);
          for (let i=0; i<curQ.length; i++){
            if (curQ[i].checked){
              curChecked = true;
            }
          }
          if (curChecked){
            this.answers.push(curQ._value)
          }else{
            this.errors.push('question'+i+' required');
            this.requiredShow[3+i]="(required)";
            e.preventDefault();
          }
        } 

        //window.scrollTo(500,0);
        if (!this.requiredShow.includes("(required)")) {
          //all required filled
          //const response = JSON.stringify({'surveyId':randomSurveyId, 'turkerId':this.turkerId, 'userEmail':this.userEmail, 'level':this.level, 'answers':this.answers})
          let timeSpentOnPage = TimeMe.getTimeOnCurrentPageInSeconds();
          alert("Thanks for your submission! " + "You used "+ timeSpentOnPage + " seconds.");
        }else{
          for (let r=0; r<this.requiredShow.length; r++){
            this.rect =null;
            if (this.requiredShow[r]=="(required)"){
              switch (r) {
                case 0: 
                  this.rect = document.getElementById("turkerId").scrollIntoView();
                  break;
                case 1: 
                  this.rect = document.getElementById("userEmail").scrollIntoView();
                  break;
                case 2: 
                  this.rect = document.getElementById("levelField").scrollIntoView();
                  break;
                default:
                  this.rect = document.getElementById("q"+(r-3)).scrollIntoView();
              }
              break;
            }
          }
        }
      }
    }
  });
  TimeMe.initialize({
	  currentPageName: "my-home-page", // current page
	  idleTimeoutInSeconds: 30 // seconds
  });
  
</script>

</body>
</html>

