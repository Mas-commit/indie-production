function delete_alert(e){
   if(!window.confirm('本当に削除しますか？')){
      window.alert('キャンセルしました'); 
      return false;
   }
   document.deleteform.submit();
};