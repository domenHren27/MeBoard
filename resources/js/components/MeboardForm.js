import Axios from "axios";

class MeboardForm {
    constructor(data) {
        Object.assign(this, data);

        this.errors = {};
    }

    submit(endpoint) {
        axios.post(endpoint, data);
    }
}

export default MeboardForm;

