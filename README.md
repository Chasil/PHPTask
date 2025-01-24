# Task Description:

Please find below the description of the task:

* Please implement an Application, which generates a github resumé for a given github account similar to http://resume.github.io/
* Create a landing page at which the user enters the account name (e.g. “mxcl”) 
* Implement a “generate button” on the landing page that redirects to a generated resumé page 
* The resume page shows the following things:
* Username and a link to the user’s website (if any is provided)
* Amount and list of repositories (name, link and description)
* Percentages of programming languages for the account (Aggregated by primary language of the repository in ratio to the size of the repository)
* Make sure to use the github API, please don't start parsing web pages manually.

# Installation

## Running

1. Run `docker-compose.yml`:
   ```bash
   docker-compose up
   ```