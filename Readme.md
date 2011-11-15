# SpecialChars Behavior

CakePHP Behavior to replace chars that are not in the western alphabet of a string with their corresponding western chars.
This is useful for example when using the Sphinx search to have the same search results come up for "Žlatko" and "Zlatko".

Use the behavior to store the contents of a db field as a cleaned up version in another db field.

When using  Sphinx Search you could use its charset table feature to also clean up the incoming search queries.
When you then also tell it to match your cleaned up db fields against the search query it should spit out the same search results
for "Žlatko" and "Zlatko".

## Installation

Move the file to your behaviors folder.

## Tutorial

In your model's `$actsAs` variable add the following:

    var $actsAs = array(
      'SpecialChars' => array('fields' => array(
        'title' => 'clean_title',
        'body' => 'clean_body'
      ));
    );

This would keep a cleaned version of `title` in the field `clean_title` whenever a record is saved.
Likewise for `body`.
Make sure to create the `clean_title` and `clean_body` fields first.


You can also manually call `replaceSpecialChars` on a model:

    $cleaned = $this->MyModel->replaceSpecialChars($string);


#Changelog

0.1.0 is the current version