# Wordpress Evergreen Timer Shortcode

![screenshot](https://github.com/shahfoyez/myContents/blob/main/evergreen.png?raw=true)

## How To Use

```bash
# Include the shortcode in your function.php file.
# Create the columns 'id' and 'end time' in the datatable 'wp_timer' 
# include the shortcode in your project.
$ [foy-timer id='1' interval='4']
  [timer-html id='1' ]
# Every time you use a new ID, the database will record a new entry, which means a new timer with a different ID and interval will be created and available for use throughout the project.
