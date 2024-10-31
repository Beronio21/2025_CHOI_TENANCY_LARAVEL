const Admin = require('../models/Admin'); // Import the Admin model
const UserManagement = require('../models/UserManagement'); // Import the UserManagement model
const SystemConfig = require('../models/SystemConfig'); // Import the SystemConfig model
const AdminNotification = require('../models/AdminNotification'); // Import the AdminNotification model
const AuditLog = require('../models/AuditLog'); // Import the AuditLog model

// Admin Controller Class
class AdminController {
    // Get all admins
    static async getAllAdmins(req, res) {
        try {
            const admins = await Admin.find();
            res.json(admins);
        } catch (error) {
            res.status(500).json({ message: error.message });
        }
    }

    // Get admin by ID
    static async getAdminById(req, res) {
        try {
            const admin = await Admin.findById(req.params.admin_id);
            if (!admin) {
                return res.status(404).json({ message: "Admin not found" });
            }
            res.json(admin);
        } catch (error) {
            res.status(500).json({ message: error.message });
        }
    }

    // Create a new admin
    static async createAdmin(req, res) {
        const { first_name, last_name, email, password_hash, contact_number, role } = req.body;
        const newAdmin = new Admin({ first_name, last_name, email, password_hash, contact_number, role });

        try {
            const savedAdmin = await newAdmin.save();
            res.status(201).json(savedAdmin);
        } catch (error) {
            res.status(400).json({ message: error.message });
        }
    }

    // Update an admin
    static async updateAdmin(req, res) {
        try {
            const updatedAdmin = await Admin.findByIdAndUpdate(req.params.admin_id, req.body, { new: true });
            if (!updatedAdmin) {
                return res.status(404).json({ message: "Admin not found" });
            }
            res.json(updatedAdmin);
        } catch (error) {
            res.status(400).json({ message: error.message });
        }
    }

    // Delete an admin
    static async deleteAdmin(req, res) {
        try {
            const admin = await Admin.findById(req.params.admin_id);
            if (!admin) {
                return res.status(404).json({ message: "Admin not found" });
            }

            await admin.remove();
            res.json({ message: "Admin deleted" });
        } catch (error) {
            res.status(500).json({ message: error.message });
        }
    }
}

module.exports = AdminController;
