import Vue from 'vue'

Vue.prototype.$constants = {
  url: {
    // トップ画面
    top: '/',
    // 記事詳細
    _article: '/', // + noteId
    // カテゴリ
    _category: '/category', // + categoryId
    // マイページ
    mypage: '/mypage',
    // マイページ > 記事
    mypage_note: '/mypage/', // + noteId
    // マイページ > 記事 > preview
    mypage_note_preview: '/mypage/preview', // + noteId
    // マイページ > カテゴリ
    mypage_category: '/mypage/category', // + categoryId
    // マイページ > フォルダ
    mypage_folder: '/mypage/folder', // + folderId
    // マイページ > 設定
    settings: '/mypage/settings',
    // エラー画面
    error: '/error'
  },
  noteStatuses: {
    nonReleased: 0,
    released: 1,
    all: 2
  },
  noteStatusesText: {
    0: '非公開',
    1: '公開中',
    2: 'すべて'
  },
  saveStatus: {
    saved: 0,
    saving: 1,
    unsaved: 2
  },
  saveStatusText: {
    0: '保存済み',
    1: '保存中...',
    2: '編集中'
  }
}
