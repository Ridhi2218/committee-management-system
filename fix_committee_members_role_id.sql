-- Add missing role_id column to committee_members table
ALTER TABLE `committee_members` 
ADD COLUMN `role_id` INT(11) NOT NULL DEFAULT 1 AFTER `emp_id`;

-- Add foreign key constraint if it doesn't exist
ALTER TABLE `committee_members` 
ADD KEY `role_id` (`role_id`);

-- Optional: If you have a specific role to set for existing members, you can update them here
-- For example, if role_id = 1 is the default role:
-- UPDATE committee_members SET role_id = 1 WHERE role_id IS NULL;
