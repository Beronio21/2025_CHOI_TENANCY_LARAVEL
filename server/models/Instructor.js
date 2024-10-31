// models/Instructor.js
const mongoose = require('mongoose');

const instructorSchema = new mongoose.Schema({
    instructor_id: { type: String, required: true, unique: true },
    first_name: { type: String, required: true },
    last_name: { type: String, required: true },
    email: { type: String, required: true, unique: true },
    password_hash: { type: String, required: true },
    contact_number: String,
    department: String,
    position: String,
    profile_picture: String,
    total_reviews: Number,
    created_at: { type: Date, default: Date.now },
    updated_at: { type: Date, default: Date.now }
});

module.exports = mongoose.model('Instructor', instructorSchema);
