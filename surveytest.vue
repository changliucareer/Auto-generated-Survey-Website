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
  <form>
  <h1>Near-synonyms Distinguishing Task</h1>
  <p>Required fields are followed by <strong><abbr title="required">*</abbr></strong>.</p>

  <section id='section1'>
    <h2>Contact information</h2>
    <p>
      <label for="turkerId">
        <span>TurkerId: </span>
        <strong><abbr title="required">*</abbr></strong>
      </label>
      <input type="text" id="turkerId" name="turkerId">
    </p>
    <p>
      <label for="mail">
        <span>E-mail: </span>
        <strong><abbr title="required">*</abbr></strong>
      </label>
      <input type="email" id="mail" name="usermail">
    </p>
    <p>
      <lable for="levelField">
        <span>English Proficiency Levels: </span>
        <strong><abbr title="required">*</abbr></strong>
      </lable>
      <fieldset id'="levelField">
        <ul>
            <li>
              <label for="level_1">
                <input type="radio" id="level_1" name="level" value="N" >
                Native / Bilingual Proficiency
              </label>
            </li>
            <li>
              <label for="level_2">
                <input type="radio" id="level_2" name="level" value="P">
                Professional Working Proficiency
              </label>
            </li>
            <li>
              <label for="level_3">
                <input type="radio" id="level_3" name="level" value="L">
                Limited Working Proficiency 
              </label>
            </li>
        </ul>
      </fieldset>
    </p>
  </section>

  <section id='section2'>
    <h2  id='section2header'>Fill in the blank tasks</h2>
    <div id="app">
      <fieldset v-for="(x,qindex) in qlist">
        <legend>{{ x.question }}</legend>
        <ul>
          <li v-for="o in x.options">
            <label for="option">
              <input type="radio" id="option" v-bind:name="qindex" value={{o}} >
              {{o}}
            </label>
          </li>
        </ul>
      </fieldset>
    </div>
  </section>

  <button type="submit" onClick="submitAnswers(this.form)">Submit answers</button>

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
      qlist: mylist
    }
  });

  
</script>

</body>
</html>

