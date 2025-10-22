<!DOCTYPE html>
<html>
<head>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<link href="myform.css" rel="stylesheet">
<script type="text/javascript" src="surveys.js"></script>
</head>

<body>

<h1></h1>

<div>
  <form  id="app" @submit="processForm" method="post">
  <h1>Near-synonyms Distinguishing Task</h1>
  <p>Required fields are followed by <strong><abbr title="required">*</abbr></strong>.</p>

  <section id='section1' name='section1'>
    <h2>Contact information</h2>
    <p>
      <label for="turkerId">
        <span>TurkerId: </span>
        <strong><abbr title="required">*</abbr></strong>
      </label>
      <input type="text" id="turkerId" name="turkerId" v-model="turkerId">
      
    </p>
    <p>
      <label for="userEmail">
        <span>E-mail: </span>
        <strong><abbr title="required">*</abbr></strong>
      </label>
      <input type="email" id="userEmail" name="userEmail" v-model="userEmail">
 
    </p>
    <p>
      <lable for="levelField">
        <span>English Proficiency Levels: </span>
        <strong><abbr title="required">*</abbr></strong>
      </lable>
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
    <h2  id='section2header'>Fill in the blank tasks</h2>
    <div>
      <fieldset v-for="(x,qindex) in qlist">
        <legend>{{ x.question }}</legend>
        <ul>
          <li v-for="o in x.options">
            <label for="option">
              <input type="radio" id="option" v-bind:name="qindex" value="o" v-model="qindex.toString()">
              {{o}}
            </label>
          </li>
        </ul>
      </fieldset>
    </div>
  </section>

  <button type="submit">Submit answers</button>

  <div class = "error-message">
  <p v-if="errors.length >= 1" >
    <b>Please correct the following error(s):</b>
    <ul>
      <li v-for="error in errors">{{ error }}</li>
    </ul>
  </p>
  </div>

  </form>

</div>

<script>
  function submitAnswers(form){
    form.submit();
  }
  
  function getRandomIntInclusive(min, max) {
  min = Math.ceil(min);
  max = Math.floor(max);
  return Math.floor(Math.random() * (max - min + 1) + min); //The maximum is inclusive and the minimum is inclusive
  }

  var randomSurveyId = getRandomIntInclusive(0,890);
  var mylist = surveys[randomSurveyId];
  

  myObject = new Vue({
    el: '#app',
    data: {
      qlist: mylist,
      turkerId: null,
      userEmail:null,
      level:null,
      question0:null,
      question1:null,
      errors: []
    },
    methods:{
      processForm: function(e){
        if (!this.turkerId){
          this.errors.push("Turker Id required");
          this.errorshowFlag=true;
          e.preventDefault();
        } 
        if (!this.userEmail){
          this.errors.push("Email required");
          this.errorshowFlag=true;
          if (typeof this.userEmail === 'email'){
            this.errors.push("invalid Email");
          }
          e.preventDefault();
        }
        if (!this.level){
          this.errors.push("English level required");
          this.errorshowFlag=true;
          e.preventDefault();
        }
        if (!this.question0){
          this.errors.push("question 0 required");
          this.errorshowFlag=true;
          e.preventDefault();
        }
        if (!this.question1){
          this.errors.push("question 1 required");
          this.errorshowFlag=true;
          e.preventDefault();
        }
        
      e.submit()
      }
    }
  });

  
</script>

</body>
</html>

