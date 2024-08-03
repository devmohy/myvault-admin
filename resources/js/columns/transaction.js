import { useUserAccess } from "@/utils/userAccess";
const { isAdmin } = useUserAccess();


const columns = [
  {
    title: "Date",
    dataIndex: "date",
  },
  {
    title: "Status",
    dataIndex: "status",
  },
  {
    title: "Reference",
    dataIndex: "reference",
  },
  {
    title: "Type",
    dataIndex: "type",
  },
  {
    title: "Amount",
    dataIndex: "amount",
  },

  {
    title: "Narration",
    dataIndex: "narration",
  },
];

export default columns;