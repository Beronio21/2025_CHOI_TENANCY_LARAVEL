const mongoose = require('mongoose');

const studentSchema = new mongoose.Schema({
  student_id: { type: String, required: true, unique: true },
  first_name: String,
  last_name: String,
  email: { type: String, required: true, unique: true },
  password_hash: String,
  contact_number: String,
  department: String,
  course: String,
  year_level: Number,
  enrollment_status: String,
  profile_picture: String,
  submission_count: Number,
  current_thesis_id: Number,
  created_at: Date,
  updated_at: Date
});

module.exports = mongoose.model('Student', studentSchema);
