Integrity Behavior
===========================================

Integrity Behavior is a CakePHP Behavior to use with Yasushi Ichikawa [MongoDb datasource plugin for CakePHP](https://github.com/ichikaway/cakephp-mongodb).

It formats the results of a `find()` action, to convert all the MongoDb object back to a simple string,
because mongodb return by default a MongoId object for the _id ($primaryKey), and a mongoDate object for all the dates.

To use, just drop the Behavior in the behavior folder of your mongodb plugin installation (usually, `Plugin/Mongodb/Model/Behavior`, and start using by adding the behavior in your model :

	public $actsAs = array('Mongodb.Integrity);

Reference
---
See <https://github.com/ichikaway/cakephp-mongodb> for the Mongodb Datasource