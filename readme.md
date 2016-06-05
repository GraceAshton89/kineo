# Installation

Running install.php from the root should set up the tables dynamically which is how I gathered the data in the first place but I have also included the sql file in the root dir which has some test data in the votes table.

The path for the voting interface is: `/kineo/vote`.

## Functionality

I decided to use Silex after discussing this during my interview, I wanted to show you that I can pick up new frameworks quickly and I am confident with working in unfamiliar environments.

There are two points that I am aware have not been finished to the standard that I wanted to achieve but I thought that it was important for me to stick to the deadline of 4-5 hours to show what I can achieve in that time.

- The queries are not built using the QueryBuilder as I was initially following the Silex documentation [here](http://silex.sensiolabs.org/doc/providers/doctrine.html) and I wasn't able to locate clear documentation for implementing the QueryBuilder interface. I decided to go with what I had working correctly.

- The graphs that I wanted to display for you as much simpler than I had intended, I wanted to use a [stacked column chart ](http://www.highcharts.com/demo/column-stacked) but I ran out of time in the end and I wanted to present something to you that was functioning.