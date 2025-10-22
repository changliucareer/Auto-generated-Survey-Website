<!DOCTYPE html>
<html>
<head>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<link href="myform.css" rel="stylesheet">
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
    <fieldset>
      <legend>English Proficiency Levels <strong><abbr title="required">*</abbr></strong></legend>
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
  </section>

  <section id='section2'>
    <h2  id='section2header'>Fill in the blank tasks</h2>
    <div id="app">
      <fieldset v-for="x in qlist">
        <legend>{{ x.question }}</legend>
        <ul>
          <li v-for="o in x.options">
            <label for="option">
              <input type="radio" id="option" name="option" value={{o}} >
              {{o}}
            </label>
          </li>
        </ul>
      </fieldset>
    </div>
  </section>

</div>

<script>
  var mylist = [{"question": "the liquid {_?_} by the sponge", "options": ["ingested", "assimilated", "digested", "imbibed", "absorbed", "incorporated"], "answer": "absorbed"}, {"question": "not merely to read the chapter , but to {_?_} its meaning", "options": ["ingest", "assimilate", "digest", "imbibe", "absorb", "incorporate"], "answer": "absorb"}, {"question": "once-lovely countryside soon {_?_} by urban sprawl", "options": ["ingested", "assimilated", "digested", "imbibed", "absorbed", "incorporated"], "answer": "absorbed"}, {"question": "too tired to {_?_} even one more idea from the complicated philosophical essay she was reading", "options": ["ingest", "assimilate", "digest", "imbibe", "absorb", "incorporate"], "answer": "ingest"}, {"question": "You may completely {_?_} a stirring play in one evening , but you will be months ____ it", "options": ["ingest", "assimilate", "digest", "imbibe", "absorb", "incorporate"], "answer": "absorb"}, {"question": "You may completely ____ a stirring play in one evening , but you will be months {_?_} it", "options": ["ingesting", "assimilating", "digesting", "imbibing", "absorbing", "incorporating"], "answer": "digesting"}, {"question": "architects who {_?_} their buildings to the environment", "options": ["ingest", "assimilate", "digest", "imbibe", "absorb", "incorporate"], "answer": "assimilate"}, {"question": "It would take the city generations to {_?_} the newcomers into the patterns of a strange life", "options": ["ingest", "assimilate", "digest", "imbibe", "absorb", "incorporate"], "answer": "assimilate"}, {"question": "{_?_} your proposals into a new system that will satisfy everyone", "options": ["ingesting", "assimilating", "digesting", "imbibing", "absorbing", "incorporating"], "answer": "incorporating"}, {"question": "Do you {_?_} alcoholic beverages ?", "options": ["ingest", "assimilate", "digest", "imbibe", "absorb", "incorporate"], "answer": "imbibe"}]


  myObject = new Vue({
    el: '#app',
    data: {
      qlist: [
       { question: 'Learn JavaScript',options:['a','b','c'] },
        { question: 'Learn Vue.js' ,options:['a','b','c']},
        { question: 'Build Something Awesome',options:['a','b','c'] }
      ]
    }
  })

</script>

</body>
</html>

