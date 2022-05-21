
import { library } from "@fortawesome/fontawesome-svg-core";
import {
    // Operations
    faPlus, faPen, faTrashCan,

    // Notification types
    faCheckCircle, faXmarkCircle, faExclamationCircle, faInfoCircle,

    // Misc
    faUser, faCreditCard, faMoneyBillTransfer, faSearch
} from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

library.add(faPlus, faPen, faTrashCan, faCheckCircle, faXmarkCircle, faExclamationCircle, faInfoCircle, faUser, faCreditCard, faMoneyBillTransfer, faSearch);

export {
    FontAwesomeIcon
}
