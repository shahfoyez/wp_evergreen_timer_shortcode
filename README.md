# Wordpress Evergreen Timer Shortcode

![screenshot](https://github.com/shahfoyez/myContents/blob/main/evergreen.png?raw=true)

## How To Use

```bash
# Copy the shortcode from function.php and paste it into the function.php file for your project.
# Make a datatable called "wp timer" with the columns "id" and "end time."
# include the shortcode in your project.
$ [foy-timer id='1' interval='4']
  [timer-html id='1' ]
# Every time a new id being used, the database will record a new entry
# Which means a new timer with a different ID and interval will be created and available for use throughout the project.
