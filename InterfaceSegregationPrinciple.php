Interface Segregation Principle:

This states that many client-specific interfaces are better than one general-purpose interface. In other words, classes should not be forced to implement interfaces they do not use.

Let's take an example of a Worker interface. This defines several different methods that can be applied to a worker at a typical development agency.

<?php 
	interface Worker {
	 
	  public function takeBreak();
	 
	  public function code();
	 
	  public function callToClient();
	 
	  public function attendMeetings();
	 
	  public function getPaid();
	}
?>

The problem is that because this interface is too generic we are forced to create methods in classes that implement this interface just to suit the interface.

For example, if we create a Manager class then we are forced to implement a code() method because that's what the interface requires.

Because managers generally don't code we can't actually do anything in this method so we just return false.

<?php
	class Manager implements Worker {
	  public function code() {
	    return false;
	  }
	}
?>

Also, if we have a Developer class that implements Worker then we are forced to implement a callToClient() method because that's what the interface requires.

<?php
	class Developer implements Worker {
	  public function callToClient() {
	    echo "I'll ask my manager.";
	  }
	}
?>

Having a fat and bloated interface means having to implement methods that do nothing.

The correct solution to this is to split our interfaces into separate parts, each of which deals with specific functionality. Here, we split out a Coder and ClientFacer interface from our generic Worker interface.

<?php 
	interface Worker {
	  public function takeBreak();
	  public function getPaid();
	}
	 
	interface Coder {
	  public function code();
	}
	 
	interface ClientFacer {
	  public function callToClient();
	  public function attendMeetings();
	}
?>
With this in place we can implement our sub-classes without having to write code that we don't need. So our Developer and Manager classes would look like this.

<?php 
	class Developer implements Worker, Coder {
	}
	 
	class Manager implements Worker, ClientFacer {
	}
?>

Having lots of specific interfaces means that we don't have to write code just to support an interface.