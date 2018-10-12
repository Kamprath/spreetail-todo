export default class {
    constructor(id, parent_id, title, description, priority, status, due_at, created_at, updated_at) {
        this.id = id;
        this.parent_id = parent_id;
        this.title = title;
        this.description = description;
        this.priority = priority || 1;
        this.status = status;
        this.due_at = due_at;
        this.created_at = created_at;
        this.updated_at = updated_at;
    }
}